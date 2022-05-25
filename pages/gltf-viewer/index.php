<header>
  <h1><a href="/">glTF Viewer</a></h1>
  <span class="separator layout-md"> | </span>
  <a class="item layout-md" target="_blank" href="https://github.com/mrdoob/three.js/tree/r139">
    three.js r139
  </a>
  <span class="separator layout-md"> | </span>
  <a class="item layout-md" target="_blank" href="https://github.com/mrdoob/three.js/blob/r139/examples/js/loaders/GLTFLoader.js">
    THREE.GLTFLoader@r139
  </a>
  <span class="separator"> | </span>
  <a class="item" target="_blank" href="https://github.com/donmccurdy/three-gltf-viewer/issues/new">
    help & feedback
  </a>
  <span class="separator"> | </span>
  <a class="item" target="_blank" href="https://github.com/donmccurdy/three-gltf-viewer">
    source
  </a>
  <span class="flex-grow"></span>
  <button id="download-btn" class="item" style="display: none">
    ⬇&nbsp;&nbsp;&nbsp;Download
  </button>
</header>
<main class="wrap">
  <div class="dropzone">
    <div class="placeholder">
      <p>Drag glTF 2.0 file or folder here</p>
    </div>
    <div class="upload-btn">
      <input type="file" name="file-input[]" id="file-input" multiple="" />
      <label for="file-input">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
          <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path>
        </svg>
        <span>Upload</span>
      </label>
    </div>
  </div>
  <div class="spinner"></div>
  <section class="custom-handler">
    <a href="?page=gltf-viewer" class="refresh-gltf-viewer">
      <img src="https://api.iconify.design/material-symbols:refresh-rounded.svg" alt="refresh">
    </a>
  </section>
</main>
<script type="text/x-handlebars-template" id="report-toggle-template">
  <div class='report-toggle level-{{issues.maxSeverity}}'>
      <div class='report-toggle-text'>
        {{#if issues}}
          {{#if issues.numErrors}}
            {{issues.numErrors}}
            errors.
          {{else if issues.numWarnings}}
            {{issues.numWarnings}}
            warnings.
          {{else if issues.numHints}}
            {{issues.numHints}}
            hints.
          {{else if issues.numInfos}}
            {{issues.numInfos}}
            notes.
          {{else}}
            Model details
          {{/if}}
        {{else if reportError}}
          Validation could not run:
          {{reportError}}.
        {{else}}
          Validation could not run.
        {{/if}}
      </div>
      <div class='report-toggle-close' aria-label='Hide'>&times;</div>
    </div>
  </script>
<script type="text/x-handlebars-template" id="report-template">
  <!DOCTYPE html>
    <title>glTF 2.0 validation report</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400" rel="stylesheet">
    <link rel="stylesheet" href="{{location.protocol}}//{{location.host}}/style.css">
    <style>
      body { overflow-y: auto; }
    </style>
    <div class="report">
      <h1>Validation report</h1>
      <ul>
        <li><b>Format:</b> glTF {{info.version}}</li>
        {{#if generator}}
          <li>
            <b>Generator:</b> {{generator.name}}
            {{#if generator.docsURL}}(<a href="{{generator.docsURL}}" target="_blank">docs</a>){{/if}}
            {{#if generator.bugsURL}}(<a href="{{generator.bugsURL}}" target="_blank">bugs</a>){{/if}}
          </li>
        {{else}}
          <li><b>Generator:</b> {{info.generator}}</li>
        {{/if}}
        {{#if info.extras}}
          {{#if info.extras.title}}<li><b>Title:</b> {{info.extras.title}}</li>{{/if}}
          {{#if info.extras.author}}<li><b>Author:</b> {{{info.extras.author}}}</li>{{/if}}
          {{#if info.extras.license}}<li><b>License:</b> {{{info.extras.license}}}</li>{{/if}}
          {{#if info.extras.source}}<li><b>Source:</b> {{{info.extras.source}}}</li>{{/if}}
        {{/if}}
        <li>
          <b>Stats:</b>
          <ul>
            <li>{{info.drawCallCount}} draw calls</li>
            <li>{{info.animationCount}} animations</li>
            <li>{{info.materialCount}} materials</li>
            <li>{{info.totalVertexCount}} vertices</li>
            <li>{{info.totalTriangleCount}} triangles</li>
          </ul>
        </li>
        <li>
          <b>Extensions:</b> {{#unless info.extensionsUsed}}None{{/unless}}
          {{#if info.extensionsUsed}}
            <ul>
            {{#each info.extensionsUsed}}
              <li>{{this}}</li>
            {{/each}}
            </ul>
            <p><i>
              NOTE: Extensions above are present in the model, but may or may not be recognized by this
              viewer. Any "UNSUPPORTED_EXTENSION" warnings below refer only to extensions that could not
              be scanned by the validation suite, and may still have rendered correctly. See:
              <a href="https://github.com/donmccurdy/three-gltf-viewer/issues/122" target="_blank">three-gltf-viewer#122</a>
          {{/if}}
        </li>
      </ul>
      <hr/>
      <p>
        Report generated by
        <a href="https://github.com/KhronosGroup/glTF-Validator/">KhronosGroup/glTF-Validator</a>
        {{validatorVersion}}.
      </p>
      {{#if issues.numErrors}}
        {{> issuesTable messages=errors color="#f44336" title="Error"}}
      {{/if}}
      {{#if issues.numWarnings}}
        {{> issuesTable messages=warnings color="#f9a825" title="Warning"}}
      {{/if}}
      {{#if issues.numHints}}
        {{> issuesTable messages=hints color="#8bc34a" title="Hint"}}
      {{/if}}
      {{#if issues.numInfos}}
        {{> issuesTable messages=infos color="#2196f3" title="Info"}}
      {{/if}}
    </div>
  </script>
<script type="text/x-handlebars-template" id="report-table-partial">
  <table class='report-table'>
      <thead>
        <tr style="background: '{{color}}';">
          <th>{{title}}</th>
          <th>Message</th>
          <th>Pointer</th>
        </tr>
      </thead>
      <tbody>
        {{#each messages}}
          <tr>
            <td><code>{{code}}</code></td>
            <td>{{message}}</td>
            <td><code>{{pointer}}</code></td>
          </tr>
        {{/each}}
        {{#unless issues.messages}}
          <tr><td colspan='3'>No issues found.</td></tr>
        {{/unless}}
      </tbody>
    </table>
  </script>
<script defer="" data-domain="gltf-viewer.donmccurdy.com" src="https://plausible.io/js/plausible.js"></script>

<script src="assets/js/main.gltf-viewer.js" type="module" defer></script>