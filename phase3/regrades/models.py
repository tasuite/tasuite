from google.appengine.ext import db


class Regrades(db.Model):

    compid = db.StringProperty()
    text = db.StringProperty(multiline=True)
    assignment = db.StringProperty()
    status = db.StringProperty()
    date = db.DateTimeProperty(auto_now_add=True)
