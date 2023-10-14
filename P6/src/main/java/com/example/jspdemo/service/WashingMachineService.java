package com.example.jspdemo.service;

import com.example.jspdemo.model.WashingMachine;
import com.example.jspdemo.repo.WashingMachineRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.ArrayList;
import java.util.List;

@Service
public class WashingMachineService {

    @Autowired
    WashingMachineRepository washingMachineRepository;

    public List<WashingMachine> getAllWashingMachine() {
        List<WashingMachine> washingMachineList = new ArrayList<>();
        washingMachineRepository.findAll().forEach(washingMachine -> washingMachineList.add(washingMachine));

        return washingMachineList;
    }

    public WashingMachine getWashingMachineById(int id) {
        return washingMachineRepository.findById(id).get();
    }

    public boolean saveOrUpdateWashingMachine(WashingMachine washingMachine) {
        WashingMachine updatedWashingMachine = washingMachineRepository.save(washingMachine);

        if (washingMachineRepository.findById(updatedWashingMachine.getId()) != null) {
            return true;
        }

        return false;
    }

    public boolean deleteWashingMachine(int id) {
        washingMachineRepository.deleteById(id);

        if (washingMachineRepository.findById(id) != null) {
            return true;
        }

        return false;
    }

}
