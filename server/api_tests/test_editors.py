"""
Editors endpoint tests
"""

import json
import unittest

import requests


class EditorsTest(unittest.TestCase):

    def test_collect_successful(self):
        ...

    def test_collect_invalid_request(self):
        ...

    def test_add_successful(self):
        ...

    def test_add_invalid_request(self):
        ...

    def test_add_invalid_contributor_id(self):
        ...

    def test_add_already_added(self):
        ...

    def test_move_up_unauthenticated(self):
        ...

    def test_move_up_successful(self):
        ...

    def test_move_up_first(self):
        ...

    def test_move_up_invalid_request(self):
        ...

    def test_move_up_invalid_contributor_id(self):
        ...

    def test_move_down_unauthenticated(self):
        ...

    def test_move_down_successful(self):
        ...

    def test_move_down_last(self):
        ...

    def test_move_down_invalid_request(self):
        ...

    def test_move_down_invalid_contributor_id(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

