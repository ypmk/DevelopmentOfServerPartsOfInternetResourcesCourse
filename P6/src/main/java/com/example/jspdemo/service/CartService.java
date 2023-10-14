package com.example.jspdemo.service;

import com.example.jspdemo.model.Cart;
import com.example.jspdemo.repo.CartRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class CartService {

    @Autowired
    CartRepository cartRepo;

    public List<Cart> getAllInCart() {
        List<Cart> cartList = new ArrayList<>();
        cartRepo.findAll().forEach(cart -> cartList.add(cart) );
        return cartList;
    }

    public Cart getCartById(int id) {
        return cartRepo.findById(id).get();
    }

    public boolean deleteFromCart(int id) {
        cartRepo.deleteById(id);

        if (cartRepo.findById(id) != null) {
            return true;
        }

        return false;
    }

    public boolean cleanCart() {
        cartRepo.deleteAll();
        return true;

    }

    public boolean makeOrder(){

        return true;
    }

    public boolean saveOrUpdateCart(Cart cart) {
        Cart updatedCart = cartRepo.save(cart);
        if (cartRepo.findById(updatedCart.getId()) != null) {
            return true;
        }
        return false;
    }

    public boolean minusOneInCart(int id) {
        cartRepo.findById(id).get().quantity --;
        saveOrUpdateCart(cartRepo.findById(id).get());
        if (cartRepo.findById(id).get().quantity == 0){
            deleteFromCart(id);
        }
        return true;

    }

    public boolean plusOneInCart(int id) {
        cartRepo.findById(id).get().quantity ++;
        saveOrUpdateCart(cartRepo.findById(id).get());
        return true;

    }




}
