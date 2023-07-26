
<?php


class User_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return type
     */
    public function GetMembers() {
        $sql = "SELECT * FROM ci_member ORDER BY LAST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    /**
     * 
     * @param type $memberId
     * @return type
     */
    public function GetUser() {
        $userName = $this->session->userdata('userName');
        $sql = "SELECT * FROM ci_user WHERE FULL_NAME = '$userName'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function GetEmail($memberId) {
        $sql = "SELECT EMAIL FROM ci_member WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row)
        {
            $result = $row['EMAIL'];
            
        }
        return $result;
    }

    public function GetContactEmail($memberId) {
        $sql = "SELECT CONTACT_EMAIL FROM ci_member WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row)
        {
            $result = $row['CONTACT_EMAIL'];
            
        }
        return $result;
    }

    public function GetGithub($memberId) {
        $sql = "SELECT GITHUB_LINK FROM ci_member WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row)
        {
            $result = $row['GITHUB_LINK'];
            
        }
        return $result;
    }

    public function GetLinkedin($memberId) {
        $sql = "SELECT LINKEDIN_LINK FROM ci_member WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row)
        {
            $result = $row['LINKEDIN_LINK'];
            
        }
        return $result;
    }

    public function GetPortfolio($memberId) {
        $sql = "SELECT PORTFOLIO_LINK FROM ci_member WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row)
        {
            $result = $row['PORTFOLIO_LINK'];
            
        }
        return $result;
    }

    // function to save members that were edited 
    public function saveMember($memberId, $data) {
        // The correct syntax for update in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->update('ci_member', $data);
    }

    // function to add members that were edited 
    public function addMember($data) {

        // The correct syntax for update in the sql
        $this->db->insert('ci_member', $data);
    }

    // function to delete member/s 
    public function deleteMember($memberId) {
        // The correct syntax for delete in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->delete('ci_member');
    }
}

?>