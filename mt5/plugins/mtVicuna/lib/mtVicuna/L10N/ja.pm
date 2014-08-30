<__trans_section component="mtVicuna">
<MTSetVar name="tempName" value="system_search">
<MTSetVarBlock name="page_title">Search Results</MTSetVarBlock>
<MTIfStraightSearch>
<MTSetVar name="search_type" value="search">
<MTElse>
<MTSetVar name="search_type" value="tag">
</MTIfStraightSearch>
<?xml version="1.0" encoding="<$MTPublishCharset$>" ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="<$MTDefaultLanguage$>" xml:lang="<$MTDefaultLanguage$>">
<head profile="http://purl.org/net/ns/metaprof">
	<MTInclude module="<__trans phrase="HTML Header">">
	<link rel="alternate" type="application/atom+xml" title="<$MTBlogName encode_html="1"$>: <__trans phrase="Search Results">" href="<$MTCGIPath$><$MTSearchScript$>?<$MTGetVar name="search_type"$>=<$MTSearchString encode_url="1"$>&amp;Template=feed&amp;IncludeBlogs=<$MTSearchIncludeBlogs$>" />
	<title><$MTGetVar name="page_title"$> - <MTBlogName encode_html="1"$></title>
</head>
<body class="individual system single">
	<$MTInclude module="<__trans phrase="Header">"$>
	<div id="content">
		<div id="main">
			<$MTInclude module="<__trans phrase="Topic Path">"$>
			<h1><$MTGetVar name="page_title"$></h1>
	 		<div class="entry">
				<ul class="info">
					<li>Search: <em><$MTSearchString$></em></li>
					<li><em><span class="count"><$MTSearchResultCount$></span></em> Hits</li>
				</ul>
				<dl class="headline">
					<MTSearchResults>
					<dt><a href="<$MTEntryPermalink$>"><$MTEntryTitle$></a><span class="date"> - Posted date: <$MTEntryDate></span></dt>
					<dd>
						<ul>
							<li class="textBody"><$MTEntryExcerpt$></li>
							<MTIfNonEmpty tag="EntryAuthorDisplayName">
							<li class="author">Posted by: <span class="name"><$MTEntryAuthorDisplayName$></span></li>
							</MTIfNonEmpty>
						<MTIfNonEmpty tag="MTEntryCategory"><li class="category">Category: <MTEntryCategories glue=" | "><a href="<$MTCategoryArchiveLink$>" title="<MTCategoryLabel> Index"><MTCategoryLabel></a></MTEntryCategories></li></MTIfNonEmpty>
						<MTEntryIfTagged><li class="tag">Tag: <MTEntryTags glue=", "><a href="<$MTTagSearchLink$>" rel="nofollow"><$MTTagName$></a></MTEntryTags></li></MTEntryIfTagged>
						</ul>
					</dd>
					</MTSearchResults>
				</dl>
			</div>
			<MTNoSearch>
				<div class="section entry">
					<h2>Error</h2>
					<div class="textBody">
						<p><__trans phrase="You did not enter anything to search for. Please try again"></p>
					</div>
				</div>
			</MTNoSearch>

			<MTNoSearchResults>
				<div class="section entry">
					<h2><__trans phrase="Search Result"></h2>
					<div class="textBody">
						<p><__trans phrase="Your search - <em><$MTSearchString$></em> -- did not match any documents."></p>
						<p><__trans phrase="Suggestions:"></p>
						<ul>
							<li><__trans phrase="Make sure all words are spelled correctly."></li>
							<li><__trans phrase="Try different keywords."></li>
							<li><__trans phrase="Try more general keywords."></li>
							<li><__trans phrase="Try decreasing the number of keywords."></li>
						</ul>
					</div>
				</div>
			</MTNoSearchResults>

			<div class="section option">
				<h2>Search</h2>
				<form method="get" action="<$MTCGIPath$><$MTSearchScript$>">
					<fieldset>
						<legend><label for="searchKeyword2">Search</label></legend>
						<div>
							<input type="hidden" name="IncludeBlogs" value="<$MTBlogID$>" />
							<input type="text" class="inputField" id="searchKeyword2" name="search" size="25" value="<$MTSearchString$>" />
							<input class="submit" type="submit" value="Search" />
						</div>
<!--
						<dl>
							<dt>Option</dt>
							<dd>
								<ul>
								<li><input type="checkbox" id="CaseSearch" name="CaseSearch" /><label for="CaseSearch"><__trans phrase="Character Case"></label></li>
								<li><input type="checkbox" id="RegexSearch" name="RegexSearch" /><label for="RegexSearch"><__trans phrase="Regex Search"></label></li>
								</ul>
							</dd>
							<dt>Area</dt>
							<dd>
								<ul>
								<li><input type="radio" id="search-element-entries" name="SearchElement" value="entries" /><label for="search-element-entries"><__trans phrase="Body text"></label></li>
								<li><input type="radio" id="search-element-comments" name="SearchElement" value="comments" /><label for="search-element-comments"><__trans phrase="Comments"></label></li>
								<li><input type="radio" id="search-element-both" name="SearchElement" value="both" /><label for="search-element-both"><__trans phrase="Both"></label></li>
								</ul>
							</dd>
						</dl>
-->
					</fieldset>
				</form>
			</div>
			<!--end option -->
			<$MTInclude module="<__trans phrase="Topic Path">"$>
		</div>
		<!-- end div#main -->
		<$MTInclude module="<__trans phrase="Utilities">"$>
		<$MTInclude module="<__trans phrase="Return to page top">"$>
	</div>
	<!-- end div#content -->
	<$MTInclude module="<__trans phrase="Footer">"$>
</body>
</html>
</__trans_section>
