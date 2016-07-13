<?php

/*
 * Copyright (C) 2016 ubv-cipee
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Memorando
 *
 * @ORM\Table(name="memorandos", uniqueConstraints={@ORM\UniqueConstraint(name="memorando_id_docente_servicio", columns={"id_docente_servicio"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Memorando {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador de la Adscripcion"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="adscripcion_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    
    
	/**
     * @var \AppBundle\Entity\DocenteServicio
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DocenteServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_docente_servicio", referencedColumnName="id", nullable=false)
     * })
     */
    protected $idDocenteServicio;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="correlativo", type="integer", nullable=false, options={"comment" = "numero de memo"})    
     */
    protected $correlativo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="ano", type="integer", nullable=false, options={"comment" = "año del memo"})    
     */
    protected $ano;
    
    /** @ORM\Column(name="fecha_memo", type="datetime", nullable=false, options={"comment" = "Fecha de actualizada la solicitud"})  
     /**
     * @Assert\Date()
     */      
    private $fecha_memo;
    
    
     /**
     * @var \AppBundle\Entity\Estatus
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Estatus")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_estatus", referencedColumnName="id", nullable=false)
     * })
     */
    protected $idEstatus;
    
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getCorrelativo()
    {
        return $this->correlativo;
    }
    
    /**
     * Set correlativo
     *
     * @param integer $correlativo
     * @return Memorando
     */
    public function setCorrelativo($correlativo)
    {
        $this->correlativo = $correlativo;

        return $this;
    }
    
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getAno()
    {
        return $this->ano;
    }
    
    /**
     * Set ano
     *
     * @param integer $ano
     * @return Memorando
     */
    public function setAno($ano)
    {
        $this->ano = $ano;

        return $this;
    }

    

     /**
     * Set idDocenteServicio
     *
     * @param \AppBundle\Entity\DocenteServicio $idDocenteServicio
     * @return DocenteServicio
     */
    public function setIdDocenteServicio(\AppBundle\Entity\DocenteServicio $idDocenteServicio = null)
    {
        $this->idDocenteServicio = $idDocenteServicio;

        return $this;
    }

    /**
     * Get idDocenteServicio
     *
     * @return \AppBundle\Entity\DocenteServicio
     */
    public function getIdDocenteServicio()
    {
        return $this->idDocenteServicio;
    }
    
    
    /**
   * @ORM\PrePersist
   */
    public function setFechaMemo()
    {
	    $this->fecha_memo = new \DateTime();	    
    }
    
    public function getFechaMemo()
    {
	    return $this->fecha_memo;
    }
   
    
    /**
     * Set idEstatus
     *
     * @param \AppBundle\Entity\Estatus $idEstatus
     * @return Estatus
     */
    public function setIdEstatus(\AppBundle\Entity\Estatus $idEstatus = null)
    {
        $this->idEstatus = $idEstatus;

        return $this;
    }

    /**
     * Get idEstatus
     *
     * @return \AppBundle\Entity\Estatus
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }
    
        
}
