package com.example.jspdemo.repo;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import com.example.jspdemo.model.Telephone;

@Repository
public interface TelephoneRepository extends JpaRepository<Telephone, Integer> {
}