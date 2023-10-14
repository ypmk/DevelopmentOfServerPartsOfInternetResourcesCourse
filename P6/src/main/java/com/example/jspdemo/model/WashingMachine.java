package com.example.jspdemo.model;

import javax.persistence.*;
import lombok.*;

@Getter
@Setter
@Entity
public class WashingMachine {
    @Id
    @GeneratedValue(strategy = GenerationType.AUTO)
    public int id;
    public String producer;
    public double tankCapacity;
    public int sellerId;
    public String productType;
    public int price;
    public String name;

}