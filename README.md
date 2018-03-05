# Silverstripe group by count
Grouped list by specified numeric amount

## Installation
Composer is the recommended way of installing SilverStripe modules.
```
composer require gorriecoe/silverstripe-groupbycount
```

## Requirements

- silverstripe/cms ^4.0

## Maintainers

- [Gorrie Coe](https://github.com/gorriecoe)

## Usage

Here is a standard list of links
```
<% if Links %>
    <ul>
        <% loop Links %>
            <li>
                <a href="$Link">$Title</a>
            </li>
        <% end_loop %>
    </ul>
<% end_if %>
```

Lets say we have 5 links and want to group them in groups of 2.
```
<% if Links %>
    <% loop Links.GroupByCount(2) %>
        <ul>
            <% loop Items %>
                <li>
                    <a href="$Link">$Title</a>
                </li>
            <% end_loop %>
        </ul>
    <% end_loop %>
<% end_if %>
```
Output
```
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
</ul>
```

Now lets say we have 8 links and want group them so that the first group has 2 links, the second group has 3 and third has 1 then repeat this pattern.
```
<% if Links %>
    <% loop Links.GroupByCount(2,3,1) %>
        <ul>
            <% loop Items %>
                <li>
                    <a href="$Link">$Title</a>
                </li>
            <% end_loop %>
        </ul>
    <% end_loop %>
<% end_if %>
```
Output
```
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
```

Finally lets say we have 11 links and the first group will have 2 links while all groups remaining will have 3.
```
<% if Links %>
    <% loop Links.GroupByCount(2,3__) %>
        <ul>
            <% loop Items %>
                <li>
                    <a href="$Link">$Title</a>
                </li>
            <% end_loop %>
        </ul>
    <% end_loop %>
<% end_if %>
```
Output
```
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
<ul>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
    <li>
        <a href="#">title</a>
    </li>
</ul>
```

## Count vs MaxCount
Within each group is `$MaxCount` which returns the defined count for that group.  This is different from `$Count` which returns the actual count for that group.
