<?php

class MemberManager extends Model
{
    public function getMembers()
    {
        return $this->getAll('member', 'Member');
    }
}