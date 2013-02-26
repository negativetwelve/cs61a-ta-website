"""
Extra rlist examples.
By: Mark Miyashita
TTh 9:30am-11am, WF 11am-12:30pm
OH Tues. 11am-12pm, 3-4pm in 751 Soda
   Wed. 2-3pm in 345 Soda
   Thurs. 11am-12pm in 345 Soda
Solutions will be gone over by throughout the coming weeks or by request during section.
"""

empty_rlist = None

def rlist(first, rest):
    return (first, rest)

def first(rlist):
    return rlist[0]

def rest(rlist):
    return rlist[1]

def map_rlist(fn, r):
    """ Applies the funcion, fn, to each item in the list and returns a new rlist
    >>> r = rlist(1, rlist(4, rlist(6, rlist(7, rlist(9, None)))))
    >>> map_rlist(lambda x: x*x, r)
    (1, (16, (36, (49, (81, None)))))
    """
    "***YOUR CODE HERE***"


def cut_rlist(r, n):
    """ Cuts r off at index n, basically, it returns an rlist of the first n items
    >>> r = rlist(2, rlist(3, rlist(5, rlist(8, None))))
    >>> cut_rlist(r, 3)
    (2, (3, (5, None)))
    >>> cut_rlist(r, 7)
    (2, (3, (5, (8, None))))
    """
    "***YOUR CODE HERE***"


def insert_into_rlist(r, item, index):
    """ Insert item into rlist, r, at index, index
    >>> r = rlist(3, rlist(4, rlist(1, rlist(7, None))))
    >>> insert_into_rlist(r, 10, 2)
    (3, (4, (10, (1, (7, None)))))
    """
    "***YOUR CODE HERE***"


def sort_rlist(r):
    """ Sort an rlist in ascending order.
    Hint: You might want to use the helper 'insert' written below
    Another hint: You might want to look up 'insertion sort' on wikipedia,
                  but feel free to use any sorting algorithm you like :D
    >>> r = rlist(3, rlist(5, rlist(1, rlist(9, rlist(7, None)))))
    >>> sort_rlist(r)
    (1, (3, (5, (7, (9, None)))))
    """
    "***YOUR CODE HERE***"


def insert(item, r):
    """ Inserts item into r in sorted order
    >>> r = rlist(4, rlist(6, rlist(8, None)))
    >>> insert(5, r)
    (4, (5, (6, (8, None))))
    """
    "***YOUR CODE HERE***"


def remove_index(r, index):
    """ Removes item from rlist at index
    >>> r = rlist(1, rlist(2, rlist(3, None)))
    >>> remove_index(r, 1)
    (1, (3, None))
    """
    "***YOUR CODE HERE***"


