<?php
interface Iproduct
{
    function getAll($offset, $count);
    function insert($payload,$src,$srcOfContent);
    function delete($id);
    function update($payload);
    function getProductById($id);
}