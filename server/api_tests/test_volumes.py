"""
Volumes endpoint tests
"""

import json
import unittest

import requests


class VolumesTest(unittest.TestCase):

    def test_collect_unauthenticated(self):
        ...

    def test_collect_successful(self):
        ...

    def test_collect_invalid_request(self):
        ...

    def test_show_successful(self):
        ...

    def test_show_invalid_request(self):
        ...

    def test_get_unauthenticated(self):
        ...

    def test_get_successful(self):
        ...

    def test_get_invalid_request(self):
        ...

    def test_get_invalid_volume_id(self):
        ...

    def test_create_unauthenticated(self):
        ...

    def test_create_successful(self):
        ...

    def test_create_invalid_request(self):
        ...

    def test_create_existing_volume(self):
        ...

    def test_create_existing_number_in_volume(self):
        ...

    def test_create_invalid_year(self):
        ...

    def test_create_invalid_month(self):
        ...

    def test_create_existing_year_and_month(self):
        ...

    def test_create_missing_cover_image(self):
        ...

    def test_update_unauthenticated(self):
        ...

    def test_update_successful(self):
        ...

    def test_update_invalid_request(self):
        ...

    def test_update_invalid_volume_id(self):
        ...

    def test_update_existing_volume(self):
        ...

    def test_update_existing_number_in_volume(self):
        ...

    def test_update_invalid_year(self):
        ...

    def test_update_invalid_month(self):
        ...

    def test_update_existing_year_and_month(self):
        ...

    def test_update_missing_cover_image(self):
        ...

    def test_remove_unauthenticated(self):
        ...

    def test_remove_successful(self):
        ...

    def test_remove_invalid_request(self):
        ...

    def test_remove_invalid_volume_id(self):
        ...

    def test_remove_in_use(self):
        ...

    def test_upload_cover_image_unauthenticated(self):
        ...

    def test_upload_cover_image_successful(self):
        ...

    def test_upload_cover_image_invalid_request(self):
        ...

    def test_upload_cover_image_missing_name(self):
        ...

    def test_upload_cover_image_missing_file(self):
        ...

