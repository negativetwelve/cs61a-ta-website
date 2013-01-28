<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
          "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head>
    <meta name="description" content ="CS61A: Structure and Interpretation of Computer Programs" /> 
    <meta name="keywords" content ="CS61A, Computer Science, CS, 61A, Programming, Berkeley, EECS" /> 
    <meta name="author" content ="Amir Kamil, Hamilton Nguyen, Joy Jeng, Keegan Mann, Stephen Martinis, Albert Wu,
                                  Julia Oh, Robert Huang, Mark Miyashita, Sharad Vikram, Soumya Basu, Richard Hwang" /> 
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <style type="text/css">@import url("https://inst.eecs.berkeley.edu/~cs61a/su12/lab/lab_style.css");</style> 

    <title>CS 61A Spring 2013: Lab 1</title> 

    <?php
    /* So all of the PHP in this file is to allow for this nice little trick to 
     * help us avoid having two versions of the questions lying around in the 
     * repository, which often leads to the two versions going out of sync which 
     * leads to annoyance for students.
     *
     * The idea's pretty simple for the PHP part, just simply have two dates: 
     *
     *    1. The current date
     *    2. The date the solutions should be released
     *
     * Using these, we now wrap our solutions in a simple PHP if statement that 
     * checks if the date is past the release date and only includes the code on 
     * the page displayed (what the server gives back to the browser) if the 
     * solutions are supposed to be released.
     *
     * We also use some PHP to create unique IDs for each of the show/hide 
     * buttons and solution divs, which are then used in the PHP generated 
     * jQuery code that we use to create the nice toggling effect.
     *
     * I apologize if the PHP/jQuery is really offensively bad, this is 
     * literally the most I've written of either for a single project so far.
     * Comments/suggestions are most welcome!
     *
     * - Tom Magrino (tmagrino@berkeley.edu)
     */
    $BERKELEY_TZ = new DateTimeZone("America/Los_Angeles");
    $RELEASE_DATE = new DateTime("01/31/2013", $BERKELEY_TZ);
    $CUR_DATE = new DateTime("now", $BERKELEY_TZ);
    $q_num = 0; // Used to make unique ids for all solutions and buttons
    ?>
  </head> 
  
  <body style="font-family: Georgia,serif;"> 

<h1>CS61A Lab 1: Control Flow</h1>
<h3>Week 2, Spring 2013</h3>

<h3 class="section_title">Warm Up: What would Python print?</h3>
<p>Predict what Python will print in response to each of these expressions.  
  Then try it and make sure your answer was correct, or if not, that you understand why!</p>
<pre class="codemargin">
# Q1
a = 1
b = a + 1
a + b + a * b 
______________

# Q2
a == b
______________

# Q3
z, y = 1, 2
print(z)
______________

# Q4
def square(x):
    print(x * x)        # Hit enter twice
a = square(b)
______________

# Q5
print(a)
______________

# Q6
def square(y):
    return y * y        # Hit enter twice
a = square(b)
print(a)
_______________
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre class="codemargin">
Q1: 5
Q2: False
Q3: 1
Q4: 4
Q5: None
Q6: 4
</pre>
</div>
<?php } ?>

<h3 class="section_title">Boolean operators</h3>
<p>1. What would Python print? Try to figure it out before you type it into the
  interpreter!</p>

<pre class="codemargin">
# Q1
a, b = 10, 6
a > b and a == 0
_______________

# Q2
a > b or a == 0
_______________

# Q3
not a > 0
_______________

# Q4
a != 0
_______________

# Q5
True and False
_______________

# Q6
True and True
_______________

# Q7
True or False
_______________

# Q8
False or False
_______________

# Q9
True and True or True and False
_______________
</pre>
</br>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
Q1: False
Q2: True
Q3: False
Q4: True
Q5: False
Q6: True
Q7: True
Q8: False
Q9: True
</pre>
</div>
<?php } ?>

<p><b>Boolean order of operations:</b> just like with mathematical operators,
  boolean operators (<span class="code">and</span>, <span class="code">or</span>,
  and <span class="code">not</span>) have an order of operations, too:</p>

<pre class="codemargin">
# highest priority
not
and
or
# lowest priority
</pre>

<p>For example, the following expression will evaluate to <span class="code">True</span>:</p>

<pre class="codemargin">
True and not False or not True and False
</pre>

<p>It might be easier to rewrite the expression like this:</p>

<pre class="codemargin">
(True and (not False)) or ((not True) and False)
</pre>

<p>If you find writing parentheses to be clearer, it is perfectly acceptable to do
so in your code.</p>

<p><b>Short-circuit operators:</b> in Python, <span class="code">and</span> and 
  <span class="code">or</span> are examples of <i>short-circuit operators</i>. 
  Consider the following line of code:</p>

<pre class="codemargin">
10 > 3 and 1 / 0 != 1
</pre>

<p>Generally, operands are evaluated from left to right in Python. The expression
<span class="code">10 > 3</span> will be evaluated first, then
<span class="code">1 / 0 != 1</span> will be evaluated. The problem is, evaluating 
<span class="code">1 / 0</span> will cause Python to raise an error! (You can try
dividing by 0 in the interpreter)</p>

<p>However, the original line of code will not cause any errors -- in fact, it will
evaluate to <span class="code">True</span>. This is made possible due to short-circuiting, 
which works in the following ways:</p>

<ul>
  <li><span class="code">and</span> will evaluate to <span class="code">True</span> only if 
      <i>all</i> the operands are <span class="code">True</span>. For multiple 
      <span class="code">and</span> statements, Python will go left to right until it runs 
      into the first <span class="code">False</span> value -- then it will just immediately 
      evaluate to <span class="code">False</span>.
  <li><span class="code">or</span> will evaluate to <span class="code">True</span> if <i>at 
      least one</i> of the operands is <span class="code">True</span>. For multiple 
      <span class="code">or</span> statements, Python will go left to right until it runs into 
      the first <span class="code">True</span> value -- then it will immediately evaluate
      to <span class="code">True</span>.</li>
</ul>

<p>Some examples:</p>

<pre class="codemargin">
>>> True and False and 1 / 0 == 1     # stops at the False
False
>>> True and 1 / 0 == 1 and False     # hits the division by zero
Traceback (most recent call last):
  ...
ZeroDivisionError: division by zero

>>> True or 1 / 0 == 1                # stops at the True
True
>>> False or 1 / 0 == 1 or True       # hits the division by zero
Traceback (most recent call last):
  ...
ZeroDivisionError: division by zero
</pre>

<p>Short-circuiting allows you to write boolean expressions while avoiding errors.
  Using division by zero as an example:</p>

<pre class="codemargin">
x != 0 and 3 / x > 3
</pre>

<p>In the line above, the first operand is used to guard against a 
  <span class="code">ZeroDivisionError</span> that could be caused by the second 
  operand.</p>

<h3 class="section_title"><span class="code">if</span> statements</h3>
<p>2. What would the Python interpreter display?</p>

<pre class="codemargin">
a, b = 10, 6

# Q1
if a==b:
    a
else:
    b
_______________

# Q2
if a == 4:
    6
elif b >= 4:
    6 + 7 + a
else: 
    25
________________

# Q3
# ';' lets you type multiple commands on one line
if b != a: a; b  
_________________
</pre>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
Q1: 6
Q2: 23
Q3: 10
</pre>
</div>
<?php } ?>

<p>The following are some <b>common mistakes</b> when using <span class="code">if</span> statements:</p>

<p>1. Using '<span class="code">=</span>' instead of '<span class="code">==</span>': 
  remember, <span class="code">=</span> (single equals) is used for <i>assignment</i>,
  while <span class="code">==</span> (double equals) is used for <i>comparison</i>.</p>

<pre class="codemargin">
# bad
if a = b:
    print("uh oh!")

# good!
if a == b:
    print("yay!")
</pre>

<p>2. Multiple comparisons: for example, trying to check if both <span class="code">x</span>
and <span class="code">y</span> are greater than 0.</p>

<pre class="codemargin">
# bad
if x and y > 0:
    print("uh oh!")

# good!
if x > 0 and y > 0:
    print("yay!")
</pre>

<b>Guarded commands</b>
<p>Consider the following function:</p>

<pre class="codemargin">
def abs(x):
    if x >= 0:
        return x
    else:
        return -x
</pre>

<p>It is syntactically correct to rewrite <span class="code">abs</span> in the
  following way:</p>

<pre class="codemargin">
def abs(x):
    if x >= 0:
        return x
    return -x       # missing else statement!
</pre>

<p>This is possible as a direct consequence of how <span class="code">return</span>
works -- when Python sees a <span class="code">return</span> statement, it will 
<i>immediately terminate</i> the function. In the above example, if <span class="code">x >= 0</span>,
Python will never reach the final line. Try to convince yourself that this is indeed the
case before moving on.</p>

<p>Keep in mind that <b>guarded commands only work if the function is terminated</b>!
  For example, the following function will <i>always</i> print "less than zero", because
  the function is not terminated in the body of the <span class="code">if</span> suite:</p>

<pre class="codemargin">
def foo(x):
    if x > 0:
        print("greater than zero")
    print("less than zero")

>>> foo(-3)
less than zero
>>> foo(4)
greater than zero
less than zero
</pre>

<p>In general, using guarded commands will make your code more concise -- however, if you find
  that it makes your code harder to read, by all means use an <span class="code">else</span>
  statement.</p>

<h3 class="section_title"><span class="code">while</span> loops</h3>

<p>3. What would Python print?</p>

<pre class="codemargin">
n = 2
def exp_decay(n):
    if n % 2 != 0:
        return
    while n > 0:
        print(n)
        n = n // 2 # See exercise 3 for an explanation of what '//' stands for
exp_decay(1024)
__________________
exp_decay(5)
__________________

</pre>

</br>

<?php if ($CUR_DATE > $RELEASE_DATE) { ?>
<button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>

<div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
1024
512
256
128
64
32
16
8
4
2
1

Nothing shows up
</pre>
</div>
<?php } ?>

<p>3. Before we write our next function, let's look at the idea of floor division 
  (rounds down to the nearest integer) versus true division (decimal division).</p>

<table border="0">
  <tr>
    <th>True Division</th>
    <th>Floor Division</th>
  </tr>
  <tr>
    <td> >>> 1 / 4</td>
    <td> >>> 1 // 4</td>
  </tr>
  <tr>
    <td>0.25</td>
    <td>0</td>
  </tr>
  <tr>
    <td> >>> 4 / 2</td>
    <td> >>> 4 // 2</td>
  </tr>
  <tr>
    <td>2.0</td>
    <td>2</td>
  </tr>
  <tr>
    <td> >>> 5 / 3</td>
    <td> >>> 5 // 3</td>
  </td>
  <tr>
    <td>1.666666666667</td>
    <td>1</td>
  </tr>
</table>

<!--
<pre>
<b>Normal Division 	 		Integer Division</b></pre>
<pre>
# <span class="code">a / b</span> → returns a float!		# <span class="code">a // b</span> → rounds down to the nearest integer
>>> 1/4					>>> 1//4 
0.25					0
>>> 4/2 				>>> 4//2 
2.0					2
>>> 5/3 				>>> 5//3 
1.666666666667				1
</pre>
-->

<p>Thus, if we have an operator "%" that gives us the remainder of dividing two numbers, 
  we can see that the following rule applies: </p>
<pre class="codemargin">
b * (a // b) + (a % b) = a
</pre>


<p>Now, define a procedure <span class="code">factors(n)</span> which takes in a number, 
  n, and prints out all of the numbers that divide n evenly. For example, a call with n=20 
  should result as follows (order doesn’t matter):</p>

<pre class="codemargin">
>>> factors(20)
20
10
5
4
2
1 
</pre>

<p>
Helpful Tip: You can use the % to find if something divides evenly into a number. % gives you a remainder, as follows:
</p>

<pre class="codemargin">
>>> 10 % 5
0
>>> 10 % 4
2
>>> 10 % 7
3
>>> 10 % 2
0
</pre>

    <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <button id="toggleButton<?php echo $q_num; ?>">Toggle Solution</button>
    <div id="toggleText<?php echo $q_num++; ?>" style="display: none">
<pre>
def factors(n):
	x = n
	while x > 0:
		if (n % x == 0):
			print(x)
		x -= 1
</pre>
    </div>
    <?php } ?>

<h3 class="section_title"><span class="code">Error messages</h3>

<p>By now, you've probably seen a couple of error messages. Even though they might
  look intimidating, error messages are actually very helpful in debugging code. The
  following are some common error messages (found at the bottom of a traceback):</p>

<ul>
  <li><b>SyntaxError</b>: Indicates that your code contains improper syntax (e.g. 
    missing a colon after an <span class="code">if</span> statement).
  <li><b>IndentationError</b>: Indicates that your code contains improper indentation
    (e.g. inconsistent indentation of a function body)
  <li><b>TypeError</b>: Indicates an attempted operation on incompatible types (e.g. 
    trying to add a boolean and an int)
  <li><b>ZeroDivisionError</b>: Indicates an attempted division by zero.
</ul>

<p>Using these descriptions of error messages, you should be able to get a beter idea of what
went wrong with your code. <b>If you run into error messages, try to identify the problem
before asking for help.</b>

<h3 class="section_title">ucb.py Features</h3>

<p>
For this course, there are a few features that you might find useful
for your assignments &ndash; the staff have provided these in a file 
called <tt>ucb.py</tt>, which will be provided with every project. 
If you would like to use the features in <code>ucb.py</code>, you will 
need to import the <tt>ucb.py</tt> file into your Python files: 
First you'll need to copy the ucb.py to your current directory, you can do this by 
running the command <pre>cp ~cs61a/lib/ucb.py .</pre> Then, you should add the following 
statement to the top of your Python file:
<pre>from ucb import main, interact</pre>
For now, we are going to go over the <tt>main</tt> feature, which 
allows you to easily test your functions:
</p>

<h4 class="section_title"><tt>main</tt></h4>

<p>An <em>entry point</em> of a program is the place where the execution starts happening. It is usually very convenient to be able to mark an entry point in a Python file for testing purposes. Say we have the following file <tt>cube.py</tt>:</p>

<pre>
def cube(x):
    return x * x * x 

print("Should be 1:", cube(1))
print("Should be 8:", cube(2))
print("Should be 27:", cube(3))
</pre>

<pre>
star [123] ~ # python3 -i cube.py
Should be 1: 1
Should be 8: 8
Should be 27: 27
>>>
</pre>

<p>One problem with this file is that the tests are not cleanly arranged: it would be much better if we had a test function that performed these tests:</p>

<pre>
def cube(x):
    return x * x * x

def run_tests():
    print("Should be 1:", cube(1))
    print("Should be 8:", cube(2))
    print("Should be 27:", cube(3))
</pre>

<p>
However, now, if I run the file, nothing happens:</p>

<pre>
star [123] ~ # python3 -i cube.py
>>>
</pre>
<p>This is because, to Python, all we have done is define two functions: <tt>cube</tt> and <tt>run_tests</tt>. We want Python to actually do something when we type in '<tt>python3 -i cube.py</tt>'. So, we specify an entry point with the <tt>@main</tt> annotation:</p>


<pre>
def cube(x):
    return x * x * x

def run_tests():
    print("Should be 1:", cube(1))
    print("Should be 8:", cube(2))
    print("Should be 27:", cube(3))

@main
def main():
    print("Starting.")
    run_tests()
    print("Ending.")

star [123] ~ # python3 -i cube.py
Starting.
Should be 1: 1
Should be 8: 8
Should be 27: 27
Ending.
>>>
</pre>

<p>
As you can see, Python will start execution at the beginning of a 
function with <code>@main</code> typed above it. The 
<code>@main</code> feature is a handy way to control what happens when
you run your Python script from the command line.
</p>

<p><b>A little word about -i:</b> If you don't know already, what the -i option does is runs your Python
script, then throws you into an interpreter. If you omit the -i option, Python will only run your script.
Note that for the last few exercises, we didn't actually need to use the interpreter prompt, so it would
have sufficed to only run <tt>python3 cube.py</tt>.</p>

    <?php if ($CUR_DATE > $RELEASE_DATE) { ?>
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script>
      <?php for ($i = 0; $i < $q_num; $i++) { ?>
    $("#toggleButton<?php echo $i; ?>").click(function () {
      $("#toggleText<?php echo $i; ?>").toggle();
    });
      <?php } ?>
    </script>
    <?php } ?>
  </body>
</html>
