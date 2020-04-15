<?php 
	class MonHoc
	{
	    public $tenMonHoc;
	    public $noiDungHoc;
	    public $ngayHoc;
	    public $tietHoc;
	    public $phongHoc;

	    /*
			Setter and Getter TenMonHoc
		*/
	    public function setTenMonHoc($name)
	    {
	        $this->tenMonHoc = $name;
	        return $this;
	    }

	    public function getTenMonHoc()
	    {
	        return $this->tenMonHoc;
	    }

 		/*
			Setter and Getter NoiDungHoc
		*/
	    public function setNoiDungHoc($name)
	    {
	        $this->noiDungHoc = $name;
	        return $this;
	    }

	    public function getNoiDungHoc()
	    {
	        return $this->noiDungHoc;
	    }

 		/*
			Setter and Getter NgayHoc
		*/
	    public function setNgayHoc($name)
	    {
	        $this->ngayHoc = $name;
	        return $this;
	    }

	    public function getNgayHoc()
	    {
	        return $this->ngayHoc;
	    }

 		/*
			Setter and Getter TietHoc
		*/
	    public function setTietHoc($name)
	    {
	        $this->tietHoc = $name;
	        return $this;
	    }

	    public function getTietHoc()
	    {
	        return $this->tietHoc;
	    }

 		/*
			Setter and Getter PhongHoc
		*/
	    public function setPhongHoc($name)
	    {
	        $this->phongHoc = $name;
	        return $this;
	    }

	    public function getPhongHoc()
	    {
	        return $this->phongHoc;
	    }
	   
	}
?>
