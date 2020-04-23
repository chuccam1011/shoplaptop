<?php
interface Iadmin
{
    function insert($payload);
    function delete($id);
    function update($payload);
    function getAdminById($id);
}