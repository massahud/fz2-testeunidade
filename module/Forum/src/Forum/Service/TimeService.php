<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Forum\Service;

/**
 * Description of TimeService
 *
 * @author GeraldoAugusto
 */
class TimeService {
    /**
     * 
     * @return \DateTime
     */
    public function getDataHoraAtual() {
        return new \DateTime();
    }
}
