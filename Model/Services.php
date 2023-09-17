<?php

class Services {
    public mixed $noserv;
    public mixed $service;
    public mixed $ville;

    /**
     * @param $noserv
     * @param $service
     * @param $ville
     */
    public function __construct($noserv, $service, $ville)
    {
        $this->noserv = $noserv;
        $this->service = $service;
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getNoserv(): mixed
    {
        return $this->noserv;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service): self
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville): self
    {
        $this->ville = $ville;
        return $this;
    }
}
