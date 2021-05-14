package com.example.teamproject.TodoList.local;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import com.example.teamproject.TodoList.TodoList;

import java.util.ArrayList;
import java.util.List;

public class TodoListLocalDAO extends SQLiteOpenHelper {
    public static final String DATABASE_NAME = "TodoList.db";
    public static final String TABLE_NAME = "todolist";

    public TodoListLocalDAO(Context context) { super(context, DATABASE_NAME, null, 1);}

    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL("CREATE TABLE " + TABLE_NAME +
                "(listID INTEGER not null PRIMARY KEY AUTOINCREMENT, " +
                "title TEXT not null, content TEXT, importance INTEGER, processHours INTEGER, " +
                "uploadDate TEXT not null DEFAULT(datetime('now', '+9 hours')), isAchieved INTEGER DEFAULT 0)");
        //isAchieved는 sqlite에 boolean이 없어서 local에서는 int로 처리
        //ID (사용자 ID)는 비회원이기 때문에 없음
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS "+TABLE_NAME);
        onCreate(db);
    }

    public boolean Insert(TodoList todoList) {
        try {
            SQLiteDatabase db = getWritableDatabase();
            ContentValues contentValues = new ContentValues();
            contentValues.put("title", todoList.getTitle());
            if(todoList.getContent()!=null)
                contentValues.put("content", todoList.getContent());
            if(todoList.getImportance()!=null)
                contentValues.put("importance", todoList.getImportance());
            if(todoList.getProcessHours()!=null)
                contentValues.put("processHours", todoList.getProcessHours());
            long result = db.insert(TABLE_NAME, null, contentValues);
            db.close();
            if(result == -1)
                return false;
            else
                return true;
        }
        catch (Exception e) {
            return false;
        }
    }

    public List<TodoList> Read(int year, int month, int day) {
        try {
            List<TodoList> todoLists = new ArrayList<TodoList>();
            SQLiteDatabase sqLiteDatabase = getWritableDatabase();
//            SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd");
//            sdf.format(new Date()); //DB전송용
//            String sdfsty = String.valueOf(sdf.format(System.currentTimeMillis()));
//            System.out.println(sdfsty);
            String smonth = "", sday = "";
            if(month< 10)
                smonth +="0";
            if(day < 10)
                sday +="0";
            String sdfstr = String.valueOf(year)+"-"+smonth+String.valueOf(month+1)+"-"+sday+String.valueOf(day);
            //System.out.println(sdfstr);
            Cursor cursor = sqLiteDatabase.rawQuery("SELECT * FROM " + TABLE_NAME + " WHERE uploadDate LIKE '"+ sdfstr +"%'", null);
            //Cursor cursor = sqLiteDatabase.rawQuery("SELECT * FROM " + TABLE_NAME + " WHERE uploadDate LIKE '"+ year +"-"+month+"-"+day+"%'", null);
            if(cursor.moveToFirst()){
                do{
                    TodoList todoList = new TodoList();
                    todoList.setID(cursor.getInt(0));
                    todoList.setTitle(cursor.getString(1));
                    todoList.setContent(cursor.getString(2));
                    todoList.setImportance(cursor.getInt(3));
                    todoList.setProcessHours(cursor.getInt(4));
                    todoList.setUploadDate(cursor.getString(5));
                    todoList.setIsAchieved(cursor.getInt(6));
                    todoLists.add(todoList);
                }while (cursor.moveToNext());
            }
            sqLiteDatabase.close();
            return todoLists;
        }
        catch (Exception e) {
            return null;
        }
    }

    public boolean Update(TodoList todoList){
        try {
            SQLiteDatabase db = getWritableDatabase();
            ContentValues contentValues = new ContentValues();
            contentValues.put("title", todoList.getTitle());
            contentValues.put("content", todoList.getContent());
            contentValues.put("importance", todoList.getImportance());
            contentValues.put("processHours", todoList.getProcessHours());
            contentValues.put("isAchieved", todoList.getIsAchieved());
            int row = db.update(TABLE_NAME, contentValues, "listID = ?", new String[]{String.valueOf(todoList.getID())});
            db.close();
            return row > 0;
        }catch (Exception e){
            return false;
        }
    }

    public boolean Delete(int ID){
        try{
            SQLiteDatabase db = getWritableDatabase();
            int row = db.delete(TABLE_NAME, "listID = ?", new String[]{String.valueOf(ID)});
            db.close();
            return row > 0;
        }catch (Exception e){
            return false;
        }
    }
}
