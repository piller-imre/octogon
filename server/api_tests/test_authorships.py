"""
Authorships endpoint tests
"""

import json
import unittest

import requests


class AuthorshipsTest(unittest.TestCase):

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        ...

    def test_create_invalid_request(self):
        ...

    def test_create_invalid_article_id(self):
        ...

    def test_create_invalid_contributor_id(self):
        ...

    def test_create_missing_given_name(self):
        ...

    def test_create_missing_family_name(self):
        ...

    def test_create_missing_affiliation(self):
        ...

    def test_create_missing_email(self):
        ...

    def test_create_already_added(self):
        ...

    def test_collect_unauthenticated(self):
        ...

    def test_collect_successful(self):
        ...

    def test_collect_invalid_request(self):
        ...

    def test_collect_invalid_article_id(self):
        ...

    def test_update_unauthenticated(self):
        ...

    def test_update_successful(self):
        ...

    def test_update_invalid_request(self):
        ...

    def test_update_invalid_authorship_id(self):
        ...

    def test_update_invalid_article_id(self):
        ...

    def test_update_invalid_contributor_id(self):
        ...

    def test_update_already_added(self):
        # TODO: Check that the authorship is unique for the given article!
        ...

    def test_update_missing_given_name(self):
        ...

    def test_update_missing_family_name(self):
        ...

    def test_update_missing_affiliation(self):
        ...

    def test_update_missing_email(self):
        ...

    def test_move_up_unauthenticated(self):
        ...

    def test_move_up_successful(self):
        ...

    def test_move_up_first(self):
        ...

    def test_move_up_invalid_request(self):
        ...

    def test_move_up_invalid_authorship_id(self):
        ...

    def test_move_down_unauthenticated(self):
        ...

    def test_move_down_successful(self):
        ...

    def test_move_down_last(self):
        ...

    def test_move_down_invalid_request(self):
        ...

    def test_move_down_invalid_authorship_id(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_invalid_authorship_id(self):
        ...

