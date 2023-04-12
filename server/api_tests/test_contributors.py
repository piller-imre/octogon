"""
Contributors endpoint tests
"""

import json
import unittest

import requests


class ContributorsTest(unittest.TestCase):

    def test_collect_unauthenticated(self):
        ...

    def test_collect_successful(self):
        ...

    def test_collect_filtered_empty(self):
        ...

    def test_collect_filtered_multiple(self):
        ...

    def test_collect_invalid_request(self):
        ...

    def test_get_unauthenticated(self):
        ...

    def test_get_successful(self):
        ...

    def test_get_invalid_request(self):
        ...

    def test_get_invalid_contributor_id(self):
        ...

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        ...

    def test_create_invalid_request(self):
        ...

    def test_create_missing_given_name(self):
        ...

    def test_create_missing_family_name(self):
        ...

    def test_create_missing_affiliation(self):
        ...

    def test_create_missing_email(self):
        ...

    def test_update_unauthenticated(self):
        ...

    def test_update_successful(self):
        ...

    def test_update_invalid_request(self):
        ...

    def test_update_invalid_contributor_id(self):
        ...

    def test_update_missing_given_name(self):
        ...

    def test_update_missing_family_name(self):
        ...

    def test_update_missing_affiliation(self):
        ...

    def test_update_missing_email(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_invalid_contributor_id(self):
        ...

    def test_remove_in_use(self):
        ...

