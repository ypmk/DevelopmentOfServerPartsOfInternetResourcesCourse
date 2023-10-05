package com.example.jspdemo.model;

import javax.persistence.*;
import lombok.*;

@Getter
@Setter
@Entity
public class Client {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    public int id;
    public String name;
    public String email;
    public String login;
    public String password;
}