# wppanel adviser

![admin-demo-preview](https://75.wp.manu.team/wp-content/uploads/2021/08/wp-admin-adviser-preview.png)

You need to create a **setup.json** in root directory.

Example of setup.json:

```javascript
{
"sections_exclude": [
    "edit.php",
    "upload.php"
    ],
"sections_include":[
        [
        "open_graph",
        "The Open Graph",
        "options-general.php?page=open-graph-wp"
        ]
    ], 
"manual_link": "https://domanin.com/manuals/"
}
```

Example of manual-content.json

```javascript
{
  "name": "adviser-posts",
  "version": "1.0.0",
  "display": "true",
  "sections": {
    "title": "How it works",
    "description": "Manual coming soon",
    "changelog": "Please see the video: <a href='#'>link</a>"
  }
}
```
