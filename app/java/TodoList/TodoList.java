package com.example.teamproject.TodoList;


import java.io.Serializable;

/*
table todolist (
        listID int not null auto_increment,
        ID varchar(20) not null,
        title varchar(30) not null,
        content varchar(255),
        importance int,
        processHours int,
        uploadDate date not null default getdate(),
        isAchieved boolean not null default false,
        primary key(listID)
        )
*/
public class TodoList implements Serializable {
    private int ID; //listID, 식별용
    private String title;
    private String content;
    private Integer importance;
    private Integer processHours;
    private String uploadDate;
    private int isAchieved;

    public int getID() { return ID; }
    public void setID(int ID) { this.ID = ID; }

    public String getTitle() { return title; }
    public void setTitle(String title) { this.title = title; }

    public String getContent() { return content; }
    public void setContent(String content) { this.content = content; }

    public Integer getImportance() { return importance; }
    public void setImportance(Integer importance) { this.importance = importance; }

    public Integer getProcessHours() { return processHours; }
    public void setProcessHours(Integer processHours) { this.processHours = processHours; }

    public String getUploadDate() { return uploadDate; }
    public void setUploadDate(String uploadDate) { this.uploadDate = uploadDate; }

    public int getIsAchieved() { return isAchieved; }
    public void setIsAchieved(int isAchieved) { this.isAchieved = isAchieved; }

    public TodoList(int ID, String title, String content, Integer importance, Integer processHours, String uploadDate, int isAchieved) {
        this.ID = ID;
        this.title = title;
        this.content = content;
        this.importance = importance;
        this.processHours = processHours;
        this.uploadDate = uploadDate;
        this.isAchieved = isAchieved;
    }

    public TodoList() {}
}
