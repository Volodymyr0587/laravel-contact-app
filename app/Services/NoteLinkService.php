<?php

namespace App\Services;

use App\Models\Note;


class NoteLinkService
{
    public function addLinksToRelatedNotes(Note $note, $tagNames)
    {
        $relatedNotes = Note::whereHas('tags', function ($query) use ($note) {
            $query->whereIn('note_tag_id', $note->tags->pluck('id'));
        })->where([
                    ['id', '!=', $note->id],
                    ['user_id', '=', $note->user_id],
                ])->get();

        foreach ($tagNames as $tagName) {
            // Add links to related articles
            foreach ($relatedNotes as $relatedNote) {
                // Use regular expressions with a callback function for replacement
                $relatedNote->body = preg_replace_callback(
                    "/\b$tagName\b/i",
                    function ($matches) use ($note, $tagName) {
                        // Create a link in the text
                        return "<a href='" . route('note.show', $note->id) . "' class='text-blue-500 underline font-bold'>$matches[0]</a>";
                    },
                    $relatedNote->body
                );
                $relatedNote->save();
            }
        }
    }

    public function removeLinksToDeletedNote(Note $deletedNote)
    {
        // Find all notes that have links to the deleted note
        $notesWithLinks = Note::where('body', 'like', "%href='" . route('note.show', $deletedNote->id) . "%")
            ->get();

        // Remove links to the deleted note from other notes
        foreach ($notesWithLinks as $noteWithLinks) {
            $noteWithLinks->body = preg_replace(
                "/<a\s+href='" . preg_quote(route('note.show', $deletedNote->id), '/') . "'[^>]*>(.*?)<\/a>/i",
                '$1',
                $noteWithLinks->body
            );
            $noteWithLinks->save();
        }
    }
}
