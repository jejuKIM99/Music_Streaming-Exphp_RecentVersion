<?php
	
	class Notification {

		private $con;
		private $name;

		public function __construct($con, $username) {
			$this->con = $con;
			$this->name = $username;
		}

		public function getname() {
			return $this->name;
		}
		public function getsubject() {
			$query = mysqli_query($this->con, "SELECT subject FROM notifications WHERE name='$this->name'");
			$row = mysqli_fetch_array($query);
			return $row['subject'];
		}

		public function getcontent() {
			$query = mysqli_query($this->con, "SELECT content FROM notifications WHERE name='$this->name'");
			$row = mysqli_fetch_array($query);
			return $row['content'];
		}

		public function getregist_day() {
			$query = mysqli_query($this->con, "SELECT regist_day FROM notifications WHERE name='$this->name'");
			$row = mysqli_fetch_array($query);
			return $row['regist_day'];
		}
	}

?>