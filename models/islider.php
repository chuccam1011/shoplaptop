<?php
interface Islider
{
    function getAll($offset, $count);
    function getAllNoLimit();
    function insert($payload);
    function delete($id);
    function update($payload);
    function getSliderById($id);
}