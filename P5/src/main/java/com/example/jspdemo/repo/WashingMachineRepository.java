package com.example.jspdemo.repo;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import com.example.jspdemo.model.WashingMachine;

@Repository
public interface WashingMachineRepository extends JpaRepository<WashingMachine, Integer> {
}