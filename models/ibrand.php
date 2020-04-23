<?php
interface Ibrand
{
    function getAll($offset, $count);
    function insert($payload);
    function delete($id);
    function update($payload);
    function getBrandById($id);
}