"""
Articles endpoint tests
"""

import json
import unittest

import requests


class ArticleTest(unittest.TestCase):

    def test_collect_successful(self):
        ...

    def test_collect_invalid_request(self):
        ...

    def test_collect_invalid_volume_id(self):
        ...

    def test_get_successful(self):
        ...

    def test_get_invalid_request(self):
        ...

    def test_get_invalid_article_id(self):
        ...

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        ...

    def test_create_invalid_request(self):
        ...

    def test_create_invalid_volume_id(self):
        ...

    def test_update_title_data_unauthenticated(self):
        ...

    def test_update_title_data_successful(self):
        ...

    def test_update_title_data_invalid_request(self):
        # TODO: Test with additional field.
        ...

    def test_update_title_data_invalid_article_id(self):
        ...

    def test_update_title_data_missing_title(self):
        ...

    def test_update_title_data_missing_abstract(self):
        ...

    def test_update_page_range_unauthenticated(self):
        ...

    def test_update_page_range_successful(self):
        ...

    def test_update_page_range_invalid_request(self):
        ...

    def test_update_page_range_invalid_article_id(self):
        ...

    def test_update_page_range_invalid_interval(self):
        ...

    def test_update_page_range_overlapping_interval(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_invalid_article_id(self):
        ...

