<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$database = 'belajar';

function tgl_indo($tgl)
{
  $tl = date('d F Y', strtotime($tgl));
  return $tl;
}
