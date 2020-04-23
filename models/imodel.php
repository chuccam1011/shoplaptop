<?php
interface Imodel
{
    function getAll($offset, $count);
    function insert($payload);
    function delete($id);
    function update($payload);
    function getById($id);
}