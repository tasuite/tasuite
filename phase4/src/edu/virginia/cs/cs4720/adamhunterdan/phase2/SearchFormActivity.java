package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;

public class SearchFormActivity extends Activity {
	
	public final static String EXTRA_MESSAGE = "edu.virginia.cs.cs4720.adamhunterdan.phase2";

    @Override
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
    	Intent intent = new Intent(this, SearchResultActivity.class);
    	EditText editText = (EditText) findViewById(R.id.search_message);
    	String searchParam = editText.getText().toString();
    	intent.putExtra(EXTRA_MESSAGE, searchParam);
    	startActivity(intent);
    	
    }
}
