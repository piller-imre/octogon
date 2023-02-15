import jinja2


def format_authors(authors):
    """
    Format the list of authors.
    """
    if len(authors) == 0:
        return ''
    elif len(authors) == 1:
        return authors[0]
    elif len(authors) == 2:
        return '{} and {}'.format(authors[0], authors[1])
    else:
        return ', '.join(authors[:-1]) + ' and ' + authors[-1]


def render_template(template_loc, file_name, **context):
    """
    Render a template from a Jinja2 template file.
    :param template_loc: directory of the template file
    :param file_name: file name
    :param context: parameters which should be substituted
    :return: generated template as a string
    """
    environment = jinja2.Environment(
        loader=jinja2.FileSystemLoader(template_loc + '/')
    )
    environment.filters['format_authors'] = format_authors
    return environment.get_template(file_name).render(**context)

