# Minimal makefile for Sphinx documentation
#

# You can set these variables from the command line, and also
# from the environment for the first two.
SPHINXOPTS    ?=
SPHINXBUILD   ?= sphinx-build
SOURCEDIR     = .
BUILDDIR      = _build

# Put it first so that "make" without argument is like "make help".
help:
	@$(SPHINXBUILD) -M help "$(SOURCEDIR)" "$(BUILDDIR)" $(SPHINXOPTS) $(O)

it:
	sphinx-build -M html . _build

open:
	xdg-open _build/html/index.html &

upload:
	rsync -avz _build/html/* imre@mat76.mat.uni-miskolc.hu:/home/imre/public_html/octogon
	echo 'http://mat76.mat.uni-miskolc.hu/~imre/octogon/'

check:
	xdg-open http://mat76.mat.uni-miskolc.hu/~imre/octogon/

.PHONY: help Makefile

# Catch-all target: route all unknown targets to Sphinx using the new
# "make mode" option.  $(O) is meant as a shortcut for $(SPHINXOPTS).
%: Makefile
	@$(SPHINXBUILD) -M $@ "$(SOURCEDIR)" "$(BUILDDIR)" $(SPHINXOPTS) $(O)
