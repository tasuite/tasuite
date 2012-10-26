import webapp2
import json
from views import MainPage, ViewRegrades, CreateRegrade, DeleteRegrade, EditRegrade

app = webapp2.WSGIApplication([
        ('/', MainPage),
        ('/view', ViewRegrades),
        ('/create', CreateRegrade), 
        ('/edit/([\d]+)', EditRegrade),
        ('/delete/([\d]+)', DeleteRegrade)
        ],
        debug=True)
