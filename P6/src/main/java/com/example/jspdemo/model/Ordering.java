package com.example.jspdemo.model;

import lombok.Getter;
import lombok.Setter;
import javax.persistence.*;
import java.util.ArrayList;
import java.util.List;

@Getter
@Setter
@Entity
public class Ordering {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    public int id;
    public String productType;
    public int price;
    public String name;
    public int quantity;
    public String client_Email;
    public String client_name;
    public String login;
    public String password;


}