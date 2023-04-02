<?php include "layout.php" ?>

<?php beforeContent() ?>
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
<script>
// https://docs.mathjax.org/en/latest/options/input/tex.html#tex-options
window.MathJax = {
  tex: {
    inlineMath: [
      ['$', '$'],
      ['\\(', '\\)']
    ],
    displayMath: [
      ['$$', '$$'],
      ['\\[', '\\]']
    ]
  }
};
</script>
<style>
div.article {
    width: 800px;
    padding: 20px;
    border: solid gray 1px;
}

div.article div.title {
    margin-bottom: 8px;
    font-weight: bold;
}

div.article div.authors {
    margin-bottom: 8px;
    font-style: italic;
}

div.article div.abstract {
    margin-bottom: 8px;
}

div.article div.pages {
    font-style: italic;
    margin-bottom: 8px;
}

div.article div.citation {
    background-color: #EEE;
    padding: 8px;
}

</style>

    <h1>Archive</h1>
    <div>

<div class="article">
    <div class="title">About one inequality from APMO, 20045-New solution and generalizations</div>
    <div class="authors"><a href="">Arkady M. Alt</a></div>
    <div class="abstract">
Original problem from APMO, 2004/5 is:
Prove that
$$
(a^2 + 2)(b^2 + 2)(c^2 + 2) \geq 9(ab + bc + ca)^2
$$
for any positive real numbers, $a, b, c$.
    </div>
    <div class="pages">pp. 100-120.</div>
    <div class="citation">
    Arkady M. Alt:
    About one inequality from APMO, 20045-New solution and generalizations,
    Octogon Mathematical Magazine,
    vol. 27, No. 1, 2019.
    pp. 100-120.
    </div>
</div>

    </div>
<?php afterContent() ?>
