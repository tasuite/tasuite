package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;

public class SearchFormRegradeActivity extends Activity {
	public final static String EXTRA_MESSAGE = "edu.virginia.cs.cs4720.adamhunterdan.phase2";

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_form_regrade);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_search_form_regrade, menu);
        return true;
    }
    public void search_regrades(View view){
    	Intent intent = new Intent(this, SearchResultRegradeActivity.class);
    	EditText editText = (EditText) findViewById(R.id.search_message_regrade);
    	String searchParam = editText.getText().toString();
    	intent.putExtra(EXTRA_MESSAGE, searchParam);
    	startActivity(intent);
    	
    }
}
