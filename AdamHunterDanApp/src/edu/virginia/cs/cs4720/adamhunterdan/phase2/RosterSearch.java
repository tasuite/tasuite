package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.annotation.SuppressLint;
import android.annotation.TargetApi;
import android.app.ActionBar;
import android.app.Activity;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;

public class RosterSearch extends Activity {
	
	public final static String EXTRA_MESSAGE = "edu.virginia.cs.cs4720.adamhunterdan.phase2";


    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_form);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_search_form, menu);
        return true;
    }
    
    public void search(View view){
    	Intent intent = new Intent(this, RosterResult.class);
    	EditText editText = (EditText) findViewById(R.id.search_message);
    	String searchParam = editText.getText().toString();
    	intent.putExtra(EXTRA_MESSAGE, searchParam);
    	startActivity(intent);
    	
    }
    public void back_to_main(View view){
    	Intent intent = new Intent(this, HorizontalMain.class);
    	startActivity(intent);
    	
    }
}
