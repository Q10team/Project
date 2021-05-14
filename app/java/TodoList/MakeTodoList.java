package com.example.teamproject.TodoList;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.example.teamproject.R;
import com.example.teamproject.TodoList.local.TodoListLocalDAO;

public class MakeTodoList extends AppCompatActivity {
    TodoListLocalDAO localdb;
    EditText et_regtitle, et_regcontent, et_regimportance, et_regprocessHours;
    Button btn_regsave, btn_regback;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.maketodolist);

        final DateData date = (DateData) getIntent().getSerializableExtra("date");

        localdb = new TodoListLocalDAO(this);

        et_regtitle = (EditText)findViewById(R.id.et_title);
        et_regcontent = (EditText)findViewById(R.id.et_content);
        et_regimportance = (EditText)findViewById(R.id.et_importance);
        et_regprocessHours = (EditText)findViewById(R.id.et_processHours);
        btn_regsave = (Button)findViewById(R.id.btn_regsave);
        btn_regback = (Button)findViewById(R.id.btn_regback);

        btn_regsave.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String title = et_regtitle.getText().toString();
                String content = et_regcontent.getText().toString();
                String importance = et_regimportance.getText().toString();
                String processHours = et_regprocessHours.getText().toString();

                if(!title.equals("") || !content.equals("") || !importance.equals("") || !processHours.equals("")){
                    TodoList todoList = new TodoList();
                    todoList.setTitle(title);
                    todoList.setContent(content);
                    todoList.setImportance(Integer.parseInt(importance));
                    todoList.setProcessHours(Integer.parseInt(processHours));

                    if (localdb.Insert(todoList)) { //case local . 로그인 상태면 외부로 intent~
                        Toast.makeText(MakeTodoList.this, "Successfully Inserted", Toast.LENGTH_SHORT).show();
                        et_regtitle.setText("");
                        et_regcontent.setText("");
                        et_regimportance.setText("");
                        et_regprocessHours.setText("");
                        Intent intent = new Intent(MakeTodoList.this, com.example.teamproject.TodoList.MainActivity.class);
                        intent.putExtra("date", date);
                        startActivity(intent);
                    }
                }else{
                    Toast.makeText(MakeTodoList.this, "비어있는 칸이 있습니다.", Toast.LENGTH_SHORT).show();
                }
            }
        });

        btn_regback.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MakeTodoList.this, com.example.teamproject.TodoList.MainActivity.class);
                intent.putExtra("date", date);
                startActivity(intent);
            }
        });
    }
}
