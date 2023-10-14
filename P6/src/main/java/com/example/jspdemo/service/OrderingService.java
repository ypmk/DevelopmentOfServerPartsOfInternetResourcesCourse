package com.example.jspdemo.service;

import com.example.jspdemo.model.Ordering;
import com.example.jspdemo.repo.OrderingRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class OrderingService {

    @Autowired
    OrderingRepository orderingRepo;

    public List<Ordering> getAllInOrdering() {
        List<Ordering> orderingList = new ArrayList<>();
        orderingRepo.findAll().forEach(ordering -> orderingList.add(ordering) );
        return orderingList;
    }






}