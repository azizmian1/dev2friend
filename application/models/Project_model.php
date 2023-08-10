<?php

class Project_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return type
     */
    public function GetProjects() {
        $sql = "SELECT * FROM ci_project ORDER BY PROJECT_ID ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }    

    // Query to get user's projects
    public function GetMyProjects($memberId) {
        $sql = "SELECT * FROM ci_project proj, ci_project_mem projMem
        WHERE proj.PROJECT_ID = projMem.PROJECT_ID AND projMem.MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * 
     * @param type $memberId
     * @return type
     */
    public function GetProject($projectId) {
        $sql = "SELECT * FROM ci_project WHERE PROJECT_ID = '$projectId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // function to save members that were edited 
    public function saveProject($projectId, $data) {
        // The correct syntax for update in the sql
        $this->db->where('PROJECT_ID', $projectId);
        $this->db->update('ci_project', $data);
    }

    // function to add members that were edited 
    public function addToProject($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_project_mem', $data);
    }

    public function grabLastProject() {
        // The correct syntax for update in the sql
        $sql ="SELECT * FROM `ci_project` ORDER BY PROJECT_ID DESC LIMIT 1";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * Function to Delete project of a Member
     */
    public function deleteMemberProject($memberId) {
        // Delete Statement Where Member ID = $data->MEMBER_ID
        // The correct syntax for delete in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->delete('ci_project_mem');
    }

    /**
     * Function to print member information on project view
     */
    public function getProjectMembers($projectId) {
        $sql = "SELECT * FROM ci_member mem, ci_project_mem minMem, ci_project min 
        WHERE mem.member_id = minMem.member_id AND min.PROJECT_ID = minMem.PROJECT_ID 
        AND minMem.PROJECT_ID = '$projectId'
        ORDER BY mem.FIRST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;

    }

    /**
     * Function to print member information on viewproject view
     */
    public function getMemberProjects($memberId) {
        $sql = "SELECT * FROM ci_member mem, ci_project_mem minMem, ci_project min 
        WHERE mem.member_id = minMem.member_id AND min.PROJECT_ID = minMem.PROJECT_ID AND minMem.member_id = '$memberId'
        ORDER BY mem.FIRST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;

    }

    // function to add project 
    public function addProject($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_project', $data);
    }

    // function to delete project 
    public function deleteProject($projectId) {
        // The correct syntax for delete in the sql
        $this->db->where('PROJECT_ID', $projectId);
        $this->db->delete('ci_project');
    }

    // function to delete project 
    public function removeFromProject($projectId, $memberId) {
        // The correct syntax for delete in the sql
        $sql = "DELETE FROM ci_project_mem WHERE MEMBER_ID = '$memberId' AND PROJECT_ID = '$projectId'";
        $query = $this->db->query($sql);
    }

     public function removeMember($projectId, $memberId) {
        // The correct syntax for delete in the sql
        $sql = "DELETE FROM ci_project_mem WHERE MEMBER_ID = '$memberId' AND PROJECT_ID = '$projectId'";
        $query = $this->db->query($sql);
    }


    // function to count the projects
    public function countProjects() {
        $sql = "SELECT COUNT(PROJECT_ID) AS projectCount FROM ci_project";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // function to count the my projects TO DO
    public function countMyProjects($memberId) {
        $sql = "SELECT COUNT(PROJECT_ID) AS myProjectsCount FROM ci_project_mem WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
}

?>
