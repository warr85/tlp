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

/**
 * Description of ServiciosCe
 *
 * @author ubv-cipee
 * @ORM\Table(name="servicios_ce", uniqueConstraints={@ORM\UniqueConstraint(name="uq_servjcios_ce", columns={"nombre"})}, indexes={@ORM\Index(name="fki_centro_estudio_servicios", columns={"id_centro_estudio"})})
 * @ORM\Entity
 */
class ServiciosCe {
    
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false, options={"comment" = "Nombre del servicio prestado por el Centro de Estudios"})
     */
    private $nombre;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment" = "Identificador del servicio"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="servicio_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    /**
     * @var \AppBundle\Entity\CentroEstudios
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\CentroEstudios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_centro_estudio", referencedColumnName="id", nullable=false)
     * })
     */
    private $idCentroEstudio;
    
    
     /**
     * Set nombre
     *
     * @param string $nombre
     * @return ServiciosCe
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }
    
    
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
     * Set idCentroEstudio
     *
     * @param \AppBundle\Entity\CentroEstudios $idEstado
     * @return CentroEstudios
     */
    public function setIdEstado(\AppBundle\Entity\CentroEstudios $idCentroEstudio = null)
    {
        $this->idCentroEstudio = $idCentroEstudio;

        return $this;
    }

    /**
     * Get idCentroEstudio
     *
     * @return \AppBundle\Entity\CentroEstudios
     */
    public function getIdCentroEstudio()
    {
        return $this->idCentroEstudio;
    }
}
