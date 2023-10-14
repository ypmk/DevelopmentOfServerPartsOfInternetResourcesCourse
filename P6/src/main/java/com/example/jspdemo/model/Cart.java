package com.example.jspdemo.model;

import lombok.Getter;
import lombok.Setter;
import javax.persistence.*;

@Getter
@Setter
@Entity
public class Cart {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    public int id;
    public String productType;
    public int price;
    public String name;
    public String available;
    public int quantity;
}
