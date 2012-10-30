package edu.virginia.cs.cs4720.adamhunterdan.phase2;

public class Student {
	public String compid;
	public String fname;
	public String lname;
	public String role;
	
	public String getCompid() {
		return compid;
	}

	public void setCompid(String compid) {
		this.compid = compid;
	}

	public String getFname() {
		return fname;
	}

	public void setFname(String fname) {
		this.fname = fname;
	}

	public String getLname() {
		return lname;
	}

	public void setLname(String lname) {
		this.lname = lname;
	}

	public String getRole() {
		return role;
	}

	public void setRole(String role) {
		this.role = role;
	}

	@Override
	public String toString() {
		return this.lname + ", " + this.fname + " (" + this.compid + ") - " + this.role; 
	}
}
