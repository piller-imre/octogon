"""
Articles endpoint tests
"""

import json
import unittest

import requests


class ArticleTest(unittest.TestCase):

    def test_collect_successful(self):
        with prepare_test_context('demo'):
            req = {
                'volumeId': 2
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/collect', json=req)
            self.assertEqual(200, resp.status_code)
            expected_response = {
                'volume': {
                    'id': 2,
                    'volume': 18,
                    'number': 2,
                    'year': 2010,
                    'month': 10,
                    'isVisible': True
                },
                'articles': [
                    {
                        'id': 6,
                        'articleType': 'research',
                        'title': 'First in second volume',
                        'authors': [
                            {
                                'givenName': 'Péter',
                                'familyName': 'Körtesi',
                                'affiliation': 'Hungary',
                                'email': 'matkp@uni-miskolc.hu'
                            },
                            {
                                'givenName': 'Mihály',
                                'familyName': 'Bencze',
                                'affiliation': 'Brasov',
                                'email': 'benczemihaly@gmail.com'
                            },
                            {
                                'givenName': 'Ovidiu T.',
                                'familyName': 'Pop',
                                'affiliation': 'Satu Mare, Romania',
                                'email': 'pop@satumare.ro'
                            }
                        ],
                        'articleFile': '',
                        'firstPage': 1,
                        'lastPage': 12
                    },
                    {
                        'id': 7,
                        'articleType': 'research',
                        'title': 'Second in second volume',
                        'authors': [
                            {
                                'givenName': 'Sever S.',
                                'familyName': 'Dragomir',
                                'affiliation': 'Australia',
                                'email': 'dragomir@octogon.com'
                            }
                        ],
                        'articleFile': '',
                        'firstPage': 13,
                        'lastPage': 19
                    },
                    {
                        'id': 8,
                        'articleType': 'proposed problems',
                        'title': 'Proposed problems',
                        'authors': [
                            {
                                'givenName': 'Mihály',
                                'familyName': 'Bencze',
                                'affiliation': 'Brasov',
                                'email': 'benczemihaly@gmail.com'
                            }
                        ],
                        'articleFile': 'PP_2010_2.pdf',
                        'firstPage': 20,
                        'lastPage': 33
                    }
                ]
            }
            self.assertEqual(expected_response, resp.json())

    def test_collect_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'id': 2
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/collect', json=req)
            self.assertEqual(400, resp.status_code)

    def test_collect_invalid_volume_id(self):
        with prepare_test_context('demo'):
            req = {
                'volumeId': 404
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/collect', json=req)
            self.assertEqual(400, resp.status_code)

    def test_get_successful(self):
        with prepare_test_context('demo'):
            req = {
                'id': 8
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/get', json=req)
            self.assertEqual(200, resp.status_code)
            expected_response = {
                'volume': {
                    'id': 2,
                    'volume': 18,
                    'number': 2,
                    'year': 2010,
                    'month': 10,
                    'isVisible': True
                },
                'article': {
                    'id': 8,
                    'articleType': 'proposed problems',
                    'title': 'Proposed problems',
                    'abstract': 'Exciting problems',
                    'authors': [
                        {
                            'givenName': 'Mihály',
                            'familyName': 'Bencze',
                            'affiliation': 'Brasov',
                            'email': 'benczemihaly@gmail.com'
                        }
                    ],
                    'articleFile': 'PP_2010_2.pdf',
                    'firstPage': 20,
                    'lastPage': 33
                }
            }
            self.assertEqual(expected_response, resp.json())

    def test_get_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'articleId': 8
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/get', json=req)
            self.assertEqual(400, resp.status_code)

    def test_get_invalid_article_id(self):
        with prepare_test_context('demo'):
            req = {
                'id': 12
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/get', json=req)
            self.assertEqual(400, resp.status_code)

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        with prepare_test_context('demo'):
            req = {
                'volumeId': 3
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/create', json=req)
            self.assertEqual(200, resp.status_code)
            self.assertEqual({'id': 10}, resp.json())

    def test_create_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'volume': 3
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/create', json=req)
            self.assertEqual(400, resp.status_code)

    def test_create_invalid_volume_id(self):
        with prepare_test_context('demo'):
            req = {
                'volumeId': 6
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/create', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_title_data_unauthenticated(self):
        ...

    def test_update_title_data_successful(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'articleType': 2,
                'title': 'Modified Title',
                'abstract': 'Altered abstract content'
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-title-data', json=req)
            self.assertEqual(200, resp.status_code)
            req = {
                'id': 3
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/get', json=req)
            self.assertEqual(200, resp.status_code)
            expected_response = {
                'volume': {
                    'id': 3,
                    'volume': 18,
                    'number': 1,
                    'year': 2010,
                    'month': 4,
                    'isVisible': True
                },
                'article': {
                    'id': 8,
                    'articleType': 'competition',
                    'title': 'Modified Title',
                    'abstract': 'Altered abstract content',
                    'authors': [
                        {
                            'givenName': 'Péter',
                            'familyName': 'Körtesi',
                            'affiliation': 'Hungary',
                            'email': 'matkp@uni-miskolc.hu'
                        }
                    ],
                    'articleFile': '',
                    'firstPage': 16,
                    'lastPage': 22
                }
            }
            self.assertEqual(expected_response, resp.json())

    def test_update_title_data_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'articleType': 2,
                'title': 'Modified Title',
                'abstract': 'Altered abstract content',
                'unnecessary': True
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-title-data', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_title_data_invalid_article_id(self):
        with prepare_test_context('demo'):
            req = {
                'id': 30,
                'articleType': 2,
                'title': 'Modified Title',
                'abstract': 'Altered abstract content'
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-title-data', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_title_data_missing_title(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'articleType': 2,
                'title': ' ',
                'abstract': 'Altered abstract content'
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-title-data', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_title_data_missing_abstract(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'articleType': 2,
                'title': 'Modified Title',
                'abstract': ' '
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-title-data', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_page_range_unauthenticated(self):
        ...

    def test_update_page_range_successful(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'firstPage': 22,
                'lastPage': 33
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-page-range', json=req)
            self.assertEqual(200, resp.status_code)
            req = {
                'id': 3
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/get', json=req)
            self.assertEqual(200, resp.status_code)
            expected_response = {
                'volume': {
                    'id': 3,
                    'volume': 18,
                    'number': 1,
                    'year': 2010,
                    'month': 4,
                    'isVisible': True
                },
                'article': {
                    'id': 8,
                    'articleType': 'competition',
                    'title': 'Modified Title',
                    'abstract': 'Altered abstract content',
                    'authors': [
                        {
                            'givenName': 'Péter',
                            'familyName': 'Körtesi',
                            'affiliation': 'Hungary',
                            'email': 'matkp@uni-miskolc.hu'
                        }
                    ],
                    'articleFile': '',
                    'firstPage': 22,
                    'lastPage': 33
                }
            }
            self.assertEqual(expected_response, resp.json())

    def test_update_page_range_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'firstPage': 22,
                'lastPage': 33,
                'further': 'field'
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-page-range', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_page_range_invalid_article_id(self):
        with prepare_test_context('demo'):
            req = {
                'id': 30,
                'firstPage': 22,
                'lastPage': 33
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-page-range', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_page_range_invalid_interval(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'firstPage': 33,
                'lastPage': 22
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-page-range', json=req)
            self.assertEqual(400, resp.status_code)

    def test_update_page_range_overlapping_interval(self):
        with prepare_test_context('demo'):
            req = {
                'id': 3,
                'firstPage': 14,
                'lastPage': 20
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/update-page-range', json=req)
            self.assertEqual(400, resp.status_code)

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        with prepare_test_context('demo'):
            req = {
                'id': 4
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/remove', json=req)
            self.assertEqual(200, resp.status_code)
            req = {
                'volumeId': 1
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/collect', json=req)
            self.assertEqual(200, resp.status_code)
            articles = resp.json()['articles']
            self.assertEqual(4, len(articles))
            article_ids = [article['id'] for article in articles]
            self.assertEqual([1, 2, 3, 5], article_ids)

    def test_remove_invalid_request(self):
        with prepare_test_context('demo'):
            req = {
                'id': 4,
                'other': ''
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/remove', json=req)
            self.assertEqual(400, resp.status_code)

    def test_remove_invalid_article_id(self):
        with prepare_test_context('demo'):
            req = {
                'id': 404
            }
            resp = requests.post('http://127.0.0.1:80/api/articles/remove', json=req)
            self.assertEqual(400, resp.status_code)
