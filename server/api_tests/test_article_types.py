"""
Article type endpoint tests
"""

import json
import unittest

import requests


class ArticleTypesTest(unittest.TestCase):

    def test_collect_unauthenticated(self):
        ...

    def test_collect_empty(self):
        with prepare_test_context('empty'):
            req = {}
            # TODO: Perform a login and use the token in the header!
            resp = requests.post('http://127.0.0.1:80/api/article-types/collect', json=req)
            self.assertEqual(200, resp.status_code)
            self.assertEqual({'articleTypes': []}, resp.json())

    def test_collect_multiple(self):
        with prepare_test_context('demo'):
            req = {}
            resp = requests.post('http://127.0.0.1:80/api/article-types/collect', json=req)
            self.assertEqual(200, resp.status_code)
            article_types = resp.json()['articleTypes']
            self.assertEqual(3, len(article_types))
            self.assertEqual({
                'id': 1,
                'name': 'research',
                'description': 'Research paper'
            }, article_types[0])
            self.assertEqual({
                'id': 2,
                'name': 'competition',
                'description': 'Mathematical competition'
            }, article_types[1])
            self.assertEqual({
                'id': 3,
                'name': 'proposed problems',
                'description': 'Some proposed problems'
            }, article_types[2])

    def test_get_successful(self):
        with prepare_test_context('demo'):
            req = {'id': 2}
            resp = requests.post('http://127.0.0.1:80/api/article-types/get', json=req)
            self.assertEqual(200, resp.status_code)
            article_type = resp.json()
            self.assertEqual({
                'id': 2,
                'name': 'competition',
                'description': 'Mathematical competition'
            }, article_type)

    def test_get_invalid_request(self):
        with prepare_test_context('demo'):
            req = {'other': 2}
            resp = requests.post('http://127.0.0.1:80/api/article-types/get', json=req)
            self.assertEqual(400, resp.status_code)

    def test_get_missing_id(self):
        with prepare_test_context('demo'):
            req = {'id': 4}
            resp = requests.post('http://127.0.0.1:80/api/article-types/get', json=req)
            self.assertEqual(400, resp.status_code)

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        with prepare_test_context('empty'):
            req = {
                'name': 'competition',
                'description': 'Mathematical competition'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/create', json=req)
            self.assertEqual(200, resp.status_code)
            self.assertEqual({'id': 1}, resp.json())

    def test_create_invalid_request(self):
        with prepare_test_context('empty'):
            req = {
                'name': 'competition'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/create', json=req)
            self.assertEqual(400, resp.status_code)

    def test_create_missing_name(self):
        with prepare_test_context('empty'):
            req = {
                'name': '',
                'description': 'Mathematical competition'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/create', json=req)
            self.assertEqual(400, resp.status_code)

    def test_create_existing_name(self):
        with prepare_test_context('demo'):
            req = {
                'name': 'competition',
                'description': 'Mathematical competition'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/create', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_unauthenticated(self):
        ...

    def test_update_successful(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'name': 'race',
                'description': 'Mathematical race'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/update', json=req)
            self.assertEqual(200, resp.status_code)
            req = {'id': 3}
            resp = requests.post('http://127.0.0.1:80/api/article-types/get', json=req)
            self.assertEqual(200, resp.status_code)
            article_type = resp.json()
            self.assertEqual({
                'id': 3,
                'name': 'race',
                'description': 'Mathematical race'
            }, article_type)

    def test_update_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'name': 'race'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/update', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_missing_type_id(self):
        with prepare_test_context('demo'):
            req = {
                'id': 4,
                'name': 'race',
                'description': 'Mathematical race'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/update', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_missing_name(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'name': '',
                'description': 'Mathematical race'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/update', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_same_name(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'name': 'proposed problems',
                'description': 'Something new'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/update', json=req)
            self.assertEqual(200, resp.status_code)
            req = {'id': 3}
            resp = requests.post('http://127.0.0.1:80/api/article-types/get', json=req)
            self.assertEqual(200, resp.status_code)
            article_type = resp.json()
            self.assertEqual({
                'id': 3,
                'name': 'proposed problems',
                'description': 'Something new'
            }, article_type)

    def test_update_existing_name(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'name': 'research',
                'description': 'Mathematical race'
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/update', json=req)
            self.assertEqual(400, resp.status_code)

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        with prepare_test_context('empty'):
            n = 10
            for i in range(1, n + 1):
                req = {
                    'name': f'competition {n}',
                    'description': f'Mathematical competition {n}'
                }
                resp = requests.post('http://127.0.0.1:80/api/article-types/create', json=req)
                self.assertEqual(200, resp.status_code)
            req = {}
            resp = requests.post('http://127.0.0.1:80/api/article-types/collect', json=req)
            self.assertEqual(200, resp.status_code)
            article_types = resp.json()['articleTypes']
            self.assertEqual(10, len(article_types))
            req = {
                'id': 5
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/remove', json=req)
            req = {}
            resp = requests.post('http://127.0.0.1:80/api/article-types/collect', json=req)
            self.assertEqual(200, resp.status_code)
            article_types = resp.json()['articleTypes']
            self.assertEqual(9, len(article_types))
            remaining_ids = [article_type['id'] for article_type in article_types]
            self.assertEqual([1, 2, 3, 4, 6, 7, 8, 9, 10], remaining_ids)

    def test_remove_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'invalid': 2
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/remove', json=req)
            self.assertEqual(400, resp.status_code)

    def test_remove_missing_id(self):
        with prepare_test_context('demo'):
            req = {
                'id': 4
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/remove', json=req)
            self.assertEqual(400, resp.status_code)

    def test_remove_in_use(self):
        with prepare_test_context('demo'):
            req = {
                'id': 1
            }
            resp = requests.post('http://127.0.0.1:80/api/article-types/remove', json=req)
            self.assertEqual(400, resp.status_code)
            req = {}
            resp = requests.post('http://127.0.0.1:80/api/article-types/collect', json=req)
            self.assertEqual(200, resp.status_code)
            article_types = resp.json()['articleTypes']
            self.assertEqual(3, len(article_types))
