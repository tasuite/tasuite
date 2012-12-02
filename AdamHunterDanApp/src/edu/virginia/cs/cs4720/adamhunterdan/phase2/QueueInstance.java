package edu.virginia.cs.cs4720.adamhunterdan.phase2;

public class QueueInstance {
	public String compid;
	public String fname;
	public String lname;
	public String location;
	public String help;
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
	public String getLocation() {
		return location;
	}
	public void setLocation(String location) {
		this.location = location;
	}
	public String getHelp() {
		return help;
	}
	public void setHelp(String help) {
		this.help = help;
	}
	public String toString(){
		return fname + " " + lname + " \t\t@" + location + " \t\tFor:" + help;
	}
}
