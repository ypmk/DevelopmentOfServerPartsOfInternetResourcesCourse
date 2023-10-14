package com.example.jspdemo.controller;

import com.example.jspdemo.service.OrderingService;
import org.springframework.ui.Model;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;



@Controller
public class OrderingController {

    @Autowired
    OrderingService orderingService;


    @GetMapping({"/order"})
    public String viewOrder(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("orderingList", orderingService.getAllInOrdering());
        model.addAttribute("message", message);

        return "Order";
    }


}