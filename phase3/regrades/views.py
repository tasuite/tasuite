import jinja2
import os
import webapp2
import json
from datetime import datetime
from google.appengine.ext import db

from models import Regrades

TEMPLATE_DIR = os.path.join(os.path.dirname(__file__), 'templates')
jinja_environment = \
    jinja2.Environment(loader=jinja2.FileSystemLoader(TEMPLATE_DIR))


class BaseHandler(webapp2.RequestHandler):

    @webapp2.cached_property
    def jinja2(self):
        return jinja2.get_jinja2(app=self.app)

    def render_template(
        self,
        filename,
        template_values,
        **template_args
        ):
        template = jinja_environment.get_template(filename)
        self.response.out.write(template.render(template_values))

class MainPage(BaseHandler):

    def get(self):
        regrades = Regrades.all()
        self.render_template('index.html', {'regrades': regrades})


class ViewRegrades(BaseHandler):
    def get(self):
        regrades = Regrades.all()
        self.render_template('view.html', {'regrades': regrades})


class CreateRegrade(BaseHandler):

    def post(self):
        n = Regrades(compid=self.request.get('compid'),
                  text=self.request.get('text'),
                  assignment=self.request.get('assignment'),
                  status=self.request.get('status'))
        n.put()
        return webapp2.redirect('/')

    def get(self):
        self.render_template('create.html', {})


class EditRegrade(BaseHandler):

    def post(self, regrade_id):
        iden = int(regrade_id)
        regrade = db.get(db.Key.from_path('Regrades', iden))
        regrade.compid = self.request.get('compid')
        regrade.text = self.request.get('text')
        regrade.assignment = self.request.get('assignment')
        regrade.status = self.request.get('status')
        regrade.date = datetime.now()
        regrade.put()
        return webapp2.redirect('/')

    def get(self, regrade_id):
        iden = int(regrade_id)
        regrade = db.get(db.Key.from_path('Regrades', iden))
        self.render_template('edit.html', {'regrade': regrade})


class DeleteRegrade(BaseHandler):

    def get(self, regrade_id):
        iden = int(regrade_id)
        regrade = db.get(db.Key.from_path('Regrades', iden))
        db.delete(regrade)
        return webapp2.redirect('/')
