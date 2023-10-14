package com.example.jspdemo.service;

import com.example.jspdemo.model.Telephone;
import com.example.jspdemo.repo.TelephoneRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class TelephoneService {

    @Autowired
    TelephoneRepository telephoneRepo;

    public List<Telephone> getAllTelephone() {
        List<Telephone> telephoneList = new ArrayList<>();
        telephoneRepo.findAll().forEach(telephone -> telephoneList.add(telephone));

        return telephoneList;
    }

    public Telephone getTelephoneById(int id) {
        return telephoneRepo.findById(id).get();
    }

    public boolean saveOrUpdateTelephone(Telephone telephone) {
        Telephone updatedTelephone = telephoneRepo.save(telephone);

        if (telephoneRepo.findById(updatedTelephone.getId()) != null) {
            return true;
        }

        return false;
    }

    public boolean deleteTelephone(int id) {
        telephoneRepo.deleteById(id);

        if (telephoneRepo.findById(id) != null) {
            return true;
        }

        return false;
    }

}
