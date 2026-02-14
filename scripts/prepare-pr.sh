#!/usr/bin/env bash
set -euo pipefail

CURRENT_BRANCH="$(git branch --show-current)"

if [[ -z "$CURRENT_BRANCH" ]]; then
  echo "❌ Não foi possível identificar a branch atual."
  exit 1
fi

if [[ -z "$(git remote)" ]]; then
  echo "❌ Nenhum remote configurado."
  echo "   Configure um remote, por exemplo:"
  echo "   git remote add origin <URL_DO_REPOSITORIO>"
  exit 1
fi

if [[ -n "$(git status --porcelain)" ]]; then
  echo "⚠️ Existem alterações não commitadas."
  echo "   Faça commit antes de abrir PR."
  git status --short
  exit 1
fi

UPSTREAM="$(git rev-parse --abbrev-ref --symbolic-full-name "${CURRENT_BRANCH}@{upstream}" 2>/dev/null || true)"
if [[ -z "$UPSTREAM" ]]; then
  REMOTE_NAME="$(git remote | head -n 1)"
  echo "⚠️ Branch sem upstream configurado."
  echo "   Execute: git push -u ${REMOTE_NAME} ${CURRENT_BRANCH}"
  exit 1
fi

echo "✅ Pré-requisitos para abrir PR estão OK."
echo "   Branch atual: ${CURRENT_BRANCH}"
echo "   Upstream: ${UPSTREAM}"
echo "   Próximo passo: abrir PR no provedor (GitHub/GitLab) ou via CLI (gh pr create)."
