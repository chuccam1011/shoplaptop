<?php
interface Icate
{
    function getAll($offset, $count);
    function insert($payload);
    function delete($id);
    function update($payload);
    function getCateById($id);
}