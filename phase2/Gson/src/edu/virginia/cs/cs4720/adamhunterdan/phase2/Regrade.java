package edu.virginia.cs.cs4720.adamhunterdan.phase2;

public class Regrade {
	public String compid;
	public String assignment;
	public String text;
	public String status;
	public String date;


	public String getCompid() {
		return compid;
	}


	public void setCompid(String compid) {
		this.compid = compid;
	}


	public String getAssignment() {
		return assignment;
	}


	public void setAssignment(String assignment) {
		this.assignment = assignment;
	}


	public String getText() {
		return text;
	}


	public void setText(String text) {
		this.text = text;
	}


	public String getStatus() {
		return status;
	}


	public void setStatus(String status) {
		this.status = status;
	}


	public String getDate() {
		return date;
	}


	public void setDate(String date) {
		this.date = date;
	}


	@Override
	public String toString() {
		return this.compid; 
	}
}
