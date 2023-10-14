package com.example.jspdemo.controller;

import org.springframework.ui.Model;
import com.example.jspdemo.model.Cart;
import com.example.jspdemo.service.CartService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;


@Controller
public class CartController {

    @Autowired
    CartService cartService;


    @GetMapping({"/cart"})
    public String viewBookList(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("cartList", cartService.getAllInCart());
        model.addAttribute("message", message);

        return "Cart";
    }

    @GetMapping("/deleteFromCart/{id}")
    public String deleteBook(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (cartService.deleteFromCart(id)) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/cart";
    }

    @GetMapping("/cleanCart")
    public String cleanCart(RedirectAttributes redirectAttributes) {
        if (cartService.cleanCart()) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/cart";
    }

    @GetMapping("/makeOrder")
    public String makeOrder(RedirectAttributes redirectAttributes) {
        if (cartService.makeOrder()) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/addClient";
    }

    @GetMapping("/minusOneInCart/{id}")
    public String minusOneInCart(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (cartService.minusOneInCart(id)) {
            redirectAttributes.addFlashAttribute("message", "Minus Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Minus Failure");
        }

        return "redirect:/cart";
    }

    @GetMapping("/plusOneInCart/{id}")
    public String plusOneInCart(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (cartService.plusOneInCart(id)) {
            redirectAttributes.addFlashAttribute("message", "Plus Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Plus Failure");
        }

        return "redirect:/cart";
    }



}

