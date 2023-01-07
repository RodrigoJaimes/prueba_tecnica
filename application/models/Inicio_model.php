
<?php
class Inicio_model extends CI_Model{

  //APARTADO PARA CRUD DE ORIGENES DE LLAMADA

  //Obtiene los origenes de llamada
  function get_origen($code){
    $this->db->select('*');
    $this->db->from('origen_llamada');

    if($code != null){
      $this->db->where('id_origen_llamada', $code);
    }

    $this->db->where('estado = 1');
        
    $query = $this->db->get();
    return $query->result();
  }

  //Funcion para insertar el registro a la tabla
  function save_origen($data){
    $result=$this->db->insert('origen_llamada',$data);
    return $result;
  }

  //Funcion para actualizar el origen
  function update_origen($code,$data){
    $this->db->where('id_origen_llamada', $code);
    $this->db->update('origen_llamada',$data);
    return true;
  }

  function delete_origen($code, $data){
    $this->db->where('id_origen_llamada', $code);

    $this->db->update('origen_llamada', $data);
    return true;
  }

  //APARTADO PARA CRUD DE TIPO LLAMADA


  //Obtiene los tipos de llamada
  function get_tipo($code){
    $this->db->select('*');
    $this->db->from('tipo_llamada');

    if($code != null){
      $this->db->where('id_tipo_llamada', $code);
    }

    $this->db->where('estado = 1');
        
    $query = $this->db->get();
    return $query->result();
  }

  //Funcion para insertar el tipo de llamada a la tabla
  function save_tipo($data){
    $result=$this->db->insert('tipo_llamada',$data);
    return $result;
  }

  //Funcion para actualizar el tipo llamada
  function update_tipo($code,$data){
    $this->db->where('id_tipo_llamada', $code);
    $this->db->update('tipo_llamada',$data);
    return true;
  }

  function delete_tipo($code, $data){
    $this->db->where('id_tipo_llamada', $code);

    $this->db->update('tipo_llamada', $data);
    return true;
  }


  //APARTADO PARA EL CRUD DE GESTIONES

  //Obtiene los tipos de llamada
  function get_gestion($code){
    $this->db->select('*');
    $this->db->from('gestion');

    $this->db->join('origen_llamada', 'origen_llamada.id_origen_llamada=gestion.origen_llamada_id');
    $this->db->join('tipo_llamada', 'tipo_llamada.id_tipo_llamada=gestion.tipo_llamada_id');

    if($code != null){
      $this->db->where('gestion.id_gestion', $code);
    }

    $this->db->where('gestion.estado = 1');
        
    $query = $this->db->get();
    return $query->result();
  }

  //Funcion para insertar el tipo de llamada a la tabla
  function save_gestion($data){
    $result=$this->db->insert('gestion',$data);
    return $result;
  }

  //Funcion para actualizar el tipo llamada
  function update_gestion($code,$data){
    $this->db->where('id_gestion', $code);
    $this->db->update('gestion',$data);
    return true;
  }

  function delete_gestion($code, $data){
    $this->db->where('id_gestion', $code);

    $this->db->update('gestion', $data);
    return true;
  }


}